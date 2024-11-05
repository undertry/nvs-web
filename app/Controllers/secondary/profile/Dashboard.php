<?php
// Se cambia user dependiendo en que carpeta este situado los controladores
namespace App\Controllers\secondary\profile;

require_once __DIR__ . '/../../../../vendor/autoload.php';
use phpseclib3\Net\SSH2;
use App\Controllers\main\BaseController;
use App\Models\tertiary\network\NetworkModel;
use \App\Models\secondary\form\UserModel;
use \App\Models\tertiary\network\DeviceModel;

// El nombre de la clase tiene que coincidir con el nomnbre del controlador
class Dashboard extends BaseController
{
    public function index()
    {

        

        // Verificar sesión y obtener usuario
        $user = session('user');
        if (!$user || $user->id_user < 1) {
            return redirect()->to('login');
        }



        return view('secondary/profile/dashboard');
    }

    public function fetchNetworks()
    {
        $ip = session('ip');

        // Verificar si la IP está en la sesión
        if (empty($ip)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: IP no asignada en la sesión.'
            ]);
        }

        $client = \Config\Services::curlrequest();
        $network = [];

        try {
            // Realizar solicitud GET para verificar si la API está disponible
            $response = $client->get('http://' . $ip . ':5000/scan');
            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $network
                ]);
            }
        } catch (\Exception $e) {
            // Si falla la conexión con la API, retornar un mensaje de error
            log_message('error', 'Error al intentar conectarse a la API: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: API no inicializada o inaccesible.'
            ]);
        }
    }

  
    public function fetchDevices()
    {
        $ip = session('ip');

        // Verificar si la IP está en la sesión
        if (empty($ip)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: IP no asignada en la sesión.'
            ]);
        }

        $client = \Config\Services::curlrequest();
        $network = [];

        try {
            // Realizar solicitud GET para verificar si la API está disponible
            $response = $client->get('http://' . $ip . ':5000/devices');
            if ($response->getStatusCode() == 200) {
                $network = json_decode($response->getBody(), true);
                return $this->response->setJSON([
                    'success' => true,
                    'data' => $network
                ]);
            }
        } catch (\Exception $e) {
            // Si falla la conexión con la API, retornar un mensaje de error
            log_message('error', 'Error al intentar conectarse a la API: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: API no inicializada o inaccesible.'
            ]);
        }
    }





    public function change_password()
    { {
            // Verificar si el usuario está autenticado y tiene un ID de usuario válido
            $user = session('user');
            if (!$user) {
                // Redirigir a la página de inicio de sesión si el usuario no está autenticado
                return view('secondary/form/login');
            } else {
                return view("secondary/user-functions/change_password");
            }
        }
    }



    //Cambio de contraseña del usuario en sesion
    public function password_change()
    {
        $userModel = new UserModel();

        $current_password = $this->request->getPost('current_password');
        $password = $this->request->getPost('password');
        $confirm_password = $this->request->getPost('confirm_password');
        $id_user = session('user')->id_user;
        $email = session('user')->email;

        // Obtener el usuario por correo electrónico
        $result = $userModel->getUserByEmail($email);

        if ($result === null || $result->id_user <= 0) {
            return redirect()->to('change_password');
        } else {
            if (password_verify($current_password, $result->password)) {
                // Verificar si los campos están vacíos
                if (empty($password) || empty($confirm_password)) {
                    $this->session->setFlashdata('error', 'ou must fill out the form');
                    return redirect()->to('change_password');
                } elseif ($password !== $confirm_password) {
                    $this->session->setFlashdata('error', 'The passwords do not match');
                    return redirect()->to('change_password');
                }
                // Verificar si la contraseña cumple con los requisitos
                if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/', $password)) {
                    $this->session->setFlashdata('error', 'The password must have at least 8 characters, 1 uppercase letter, and 1 special character');
                    return redirect()->to('change_password');
                }
                // Cambiar la contraseña si todas las validaciones son correctas
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $data["password"] = $hashedPassword;
                $userModel->password_change($id_user, $data);

                $this->session->setFlashdata('success', 'Password changed successfully.');
                return redirect()->to('dashboard');
            } else {
                $this->session->setFlashdata('error', 'Invalid current password.');
                return redirect()->to('change_password');
            }
        }
        // Redirigir de nuevo a la página de inicio de sesión si el usuario no se encuentra
        return redirect()->to('login');
    }

    public function verification()
    {
        $session = session();
        $email = $session->get('user')->email;

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user) {
            $verificationstatus = $user->verification == 1 ? 0 : 1;  // Cambia de 1 a 0 o de 0 a 1
            $userModel->verification($email, $verificationstatus);
            $user->verification = $verificationstatus;
            unset($user->password);
            // Actualizar la sesión con el nuevo estado de verificacion
            $session->set('user', $user);
        }

        return redirect()->back();
    }

    public function animation()
    {
        return view('animations/dashboard/animation');
    }

    public function configuration()
    {
        $ip = session('ip');
        // Verificar sesión y obtener usuario
        $user = session('user');
        if (!$user || $user->id_user < 1) {
            return redirect()->to('login');
        }

        // Preparar los datos para la vista sin la lista de redes WiFi
        $data = [
            'network' => [],  // Vacío inicialmente
            'last_network' => null,
            'last_ip' => session('ip')
        ];
        return view('secondary/profile/configuration', $data);
    }

    public function setCredentials()
    {
        // Validar que el usuario esté logueado
        $user = session('user');
        if (!$user || $user->id_user < 1) {
            return redirect()->to('login');
        }

        // Obtener credenciales del formulario
        $raspberry_user = $this->request->getPost('raspberry_user');
        $raspberry_password = $this->request->getPost('raspberry_password');

        if ($raspberry_user && $raspberry_password) {
            // Guardar las credenciales en la sesión
            session()->set('raspberry_user', $raspberry_user);
            session()->set('raspberry_password', $raspberry_password);

            return redirect()->back()->with('success', 'Credenciales guardadas exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Debe ingresar el usuario y la contraseña.');
        }
    }
    public function startApi()
    {
        $ip = session('ip');
        $user = session('raspberry_user');
        $password = session('raspberry_password');
    
        if (!$ip || !$user || !$password) {
            return redirect()->back()->with('api_message', 'Error: IP o credenciales no asignadas.');
        }
    
        try {
            $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
            if (!$ssh->login($user, $password)) {
                throw new \Exception('Error: No se pudo establecer conexión SSH.');
            }
    
            // Verificar si la API ya está en ejecución
            $status = $ssh->exec('pgrep -f api_server.py');
            if (trim($status) != "") {
                $ssh->disconnect();
                return redirect()->back()->with('api_message', 'La API ya se encuentra en ejecución.');
            }
    
            // Iniciar la API en segundo plano con nohup y disown
            $output = $ssh->exec('cd ~/nvs_project && sudo nohup python3 api_server.py > api_server.log 2>&1 & disown');
            
            // Confirmar que la API se inició
            $status = $ssh->exec('pgrep -f api_server.py');
            $ssh->disconnect();
            
            if (trim($status) != "") {
                return redirect()->back()->with('api_message', 'La API se inició correctamente.');
            } else {
                throw new \Exception('Error: No se pudo iniciar correctamente la API.');
            }
        } catch (\Exception $e) {
            if (isset($ssh)) {
                $ssh->disconnect();
            }
            return redirect()->back()->with('api_message', $e->getMessage());
        }
    }
    

    
    
    public function stopApi()
{
    // Obtener IP, usuario y contraseña desde la sesión
    $ip = session('ip');
    $user = session('raspberry_user');
    $password = session('raspberry_password');

    // Verificar que IP, usuario y contraseña estén presentes
    if (!$ip || !$user || !$password) {
        return redirect()->back()->with('api_message', 'Error: IP o credenciales no asignadas.');
    }

    try {
        // Crear instancia de SSH
        $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera


        // Intentar la conexión usando el usuario y la contraseña
        if (!$ssh->login($user, $password)) {
            throw new \Exception('Error: No se pudo establecer conexión SSH.');
        }

        // Ejecutar el comando para detener el servidor de API
        $ssh->exec('pkill -f api_server.py');

        // Verificar si el proceso api_server.py sigue en ejecución
        $status = $ssh->exec('pgrep -f api_server.py');
        $ssh->disconnect();

        if (trim($status) == "") {
            return redirect()->back()->with('api_message', 'La API se detuvo correctamente.');
        } else {
            throw new \Exception('Error: No se pudo detener correctamente la API.');
        }
    } catch (\Exception $e) {
        // Asegurarse de cerrar la conexión en caso de error
        if (isset($ssh)) {
            $ssh->disconnect();
        }
        return redirect()->back()->with('api_message', $e->getMessage());
    }
}
public function enableMonitor()
{
    $ip = session('ip');
    $user = session('raspberry_user');
    $password = session('raspberry_password');

    if (!$ip || !$user || !$password) {
        return redirect()->back()->with('monitor_message', 'Error: IP o credenciales no asignadas.');
    }

    try {
        // Crear instancia de SSH
        $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
        if (!$ssh->login($user, $password)) {
            throw new \Exception('Error: No se pudo establecer conexión SSH.');
        }

        // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
        $output = $ssh->exec('sudo airmon-ng start wlan0');

          // Verificar si el modo monitor se activó correctamente
          if (strpos($output, 'monitor mode enabled') !== false || strpos($output, 'wlan0mon') !== false) {
            // El modo monitor se activó correctamente
            $monitor_message = 'Modo monitor activado correctamente.';
        } else {
            throw new \Exception('Error: No se pudo activar el modo monitor.');
        }

        $ssh->disconnect();

        // Evaluar el resultado para confirmar el éxito o el error
        if (strpos($output, 'Error') === false) {
            return redirect()->back()->with('monitor_message', 'Se establecio correctamente el modo monitor.');
        } else {
            throw new \Exception('Error durante la ejecución del escaneo de WiFi.');
        }
    } catch (\Exception $e) {
        if (isset($ssh)) {
            $ssh->disconnect();
        }
        return redirect()->back()->with('monitor_message', $e->getMessage());
    }
}

public function desactiveMonitor()
{
    $ip = session('ip');
    $user = session('raspberry_user');
    $password = session('raspberry_password');

    if (!$ip || !$user || !$password) {
        return redirect()->back()->with('monitor_message', 'Error: IP o credenciales no asignadas.');
    }

    try {
        // Crear instancia de SSH
        $ssh = new SSH2($ip, 22, 10); // 10 segundos de espera
        if (!$ssh->login($user, $password)) {
            throw new \Exception('Error: No se pudo establecer conexión SSH.');
        }

        // Ejecutar el comando para iniciar el escaneo de WiFi en segundo plano con nohup y disown
        $output = $ssh->exec('sudo airmon-ng stop wlan0mon');
        
          // Verificar si el modo monitor se activó correctamente
          if (strpos($output, 'monitor mode disabled') !== false || strpos($output, 'wlan0') !== false) {
            // El modo monitor se activó correctamente
            $monitor_message = 'Modo monitor desactivado correctamente.';
        } else {
            throw new \Exception('Error: No se pudo desactivar el modo monitor.');
        }

        $ssh->disconnect();

        // Evaluar el resultado para confirmar el éxito o el error
        if (strpos($output, 'Error') === false) {
            return redirect()->back()->with('monitor_message', 'El escaneo de WiFi se inició correctamente.');
        } else {
            throw new \Exception('Error durante la ejecución del escaneo de WiFi.');
        }
    } catch (\Exception $e) {
        if (isset($ssh)) {
            $ssh->disconnect();
        }
        return redirect()->back()->with('monitor_message', $e->getMessage());
    }
}

}

