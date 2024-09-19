<div class="software" id="container"></div>

<!-- Incluimos three.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
// Configuramos la escena, la cámara y el renderizador
let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
let renderer = new THREE.WebGLRenderer();

renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('container').appendChild(renderer.domElement);

// Configuramos el color de fondo desde CSS
renderer.setClearColor(getComputedStyle(document.documentElement).getPropertyValue('--color-dark'));

// Cargamos la textura para los puntos circulares
let loader = new THREE.TextureLoader();
let circleTexture = loader.load('https://threejs.org/examples/textures/sprites/disc.png');

// Creamos una geometría de esfera
let geometry = new THREE.SphereGeometry(5, 32, 32);

// Configuramos el material para los puntos (color más claro)
let material = new THREE.PointsMaterial({
    color: 0xcccccc, // Color más claro (gris claro)
    size: 0.05, // Tamaño pequeño
    map: circleTexture,
    transparent: true,
    alphaTest: 0.5
});

// Creamos la esfera con puntos
let sphere = new THREE.Points(geometry, material);
scene.add(sphere);

// Posición de la cámara
camera.position.z = 10;

// Variables para control de rotación
let isDragging = false;
let previousMousePosition = {
    x: 0
};
let rotationSpeed = 0.030; // Hacer la rotación más lenta para más "resistencia"
let dampingFactor = 0.05; // Factor de amortiguación para ralentizar la rotación

// Rotación automática lenta en el eje Y
let autoRotateSpeed = 0.002; // Muy suave

// Función para manejar el movimiento del ratón
function onMouseMove(event) {
    if (isDragging) {
        let deltaMove = {
            x: event.offsetX - previousMousePosition.x
        };

        // Controlamos la rotación en función de la distancia de movimiento, pero aplicando un factor de resistencia
        let deltaRotationQuaternion = new THREE.Quaternion().setFromEuler(new THREE.Euler(
            0, // Sin rotación en X
            deltaMove.x * rotationSpeed * dampingFactor, // Rotación más lenta (resistencia)
            0,
            'XYZ'
        ));

        sphere.quaternion.multiplyQuaternions(deltaRotationQuaternion, sphere.quaternion);

        previousMousePosition = {
            x: event.offsetX
        };
    }
}

// Funciones para controlar el arrastre del ratón
function onMouseDown(event) {
    isDragging = true;
    previousMousePosition = {
        x: event.offsetX
    };
}

function onMouseUp() {
    isDragging = false;
}

// Eventos para detectar movimiento del ratón
renderer.domElement.addEventListener('mousemove', onMouseMove);
renderer.domElement.addEventListener('mousedown', onMouseDown);
renderer.domElement.addEventListener('mouseup', onMouseUp);

// Animación
function animate() {
    requestAnimationFrame(animate);

    // Rotación automática en el eje Y
    if (!isDragging) {
        sphere.rotation.y += autoRotateSpeed;
    }

    renderer.render(scene, camera);
}

animate();

// Ajuste del renderizado en caso de cambiar el tamaño de la ventana
window.addEventListener('resize', () => {
    let width = window.innerWidth;
    let height = window.innerHeight;
    renderer.setSize(width, height);
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
});
</script>