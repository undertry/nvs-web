<div id="container"></div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/18.6.4/tween.umd.js"></script>

<script>
// Configuración básica de la escena, cámara y renderizador
let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
let renderer = new THREE.WebGLRenderer();

renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('container').appendChild(renderer.domElement);

// Configuramos el color de fondo desde CSS
renderer.setClearColor('#0c0b0b');

// Cargamos la textura para los puntos circulares
let loader = new THREE.TextureLoader();
let circleTexture = loader.load('https://threejs.org/examples/textures/sprites/disc.png');

// Creamos una geometría de esfera
let geometry = new THREE.SphereGeometry(4, 42, 32);

// Configuramos el material para los puntos
let material = new THREE.PointsMaterial({
    color: 0xcccccc,
    size: 0.1,
    map: circleTexture,
    transparent: true,
    alphaTest: 0.5
});

// Creamos la esfera con puntos
let sphere = new THREE.Points(geometry, material);
scene.add(sphere);

// Posición de la cámara
camera.position.z = 10;

// Variable para controlar si la esfera ha sido agrandada
let isExpanded = false;

// Función para agrandar la esfera
function expandSphere() {
    if (!isExpanded) {
        isExpanded = true;
        let scaleFactor = {
            value: 1
        };
        let tween = new TWEEN.Tween(scaleFactor)
            .to({
                value: 3
            }, 2000)
            .easing(TWEEN.Easing.Quadratic.Out)
            .onUpdate(() => {
                sphere.scale.set(scaleFactor.value, scaleFactor.value, scaleFactor.value);
            })
            .start();
    }
}

// Añadimos el evento de clic para agrandar la esfera
document.getElementById('container').addEventListener('click', expandSphere);

// Animación básica con rotación automática en el eje Y
function animate() {
    requestAnimationFrame(animate);

    // Rotación automática en el eje Y
    sphere.rotation.y += 0.001;

    TWEEN.update(); // Actualizamos las animaciones de TWEEN

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