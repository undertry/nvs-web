function updateSphereColor(mode) {
    const pointColor = mode === "light" ? 0x151414 : 0xcfcfcf;
    const lineColor = mode === "light" ? 0xcfcfcf : 0x535151;
  
    points.material.color.set(pointColor);
  
    line.material.color.set(lineColor);
  }
  
  let scene = new THREE.Scene();
  let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
  let renderer = new THREE.WebGLRenderer({
    alpha: true
  });
  renderer.setSize(window.innerWidth, window.innerHeight);
  document.getElementById('sphere-js').appendChild(renderer.domElement);
  renderer.setClearColor(0x000000, 0);
  
  let loader = new THREE.TextureLoader();
  let circleTexture = loader.load('https://threejs.org/examples/textures/sprites/disc.png');
  let geometry = new THREE.IcosahedronGeometry(2, 1);
  let material = new THREE.PointsMaterial({
    color: 0xffffff,
    size: 0.1,
    map: circleTexture,
    alphaTest: 0.5
  });
  
  let wireframeMaterial = new THREE.LineBasicMaterial({
    color: 0x555555
  });
  let wireframe = new THREE.WireframeGeometry(geometry);
  let points = new THREE.Points(geometry, material);
  let line = new THREE.LineSegments(wireframe, wireframeMaterial);
  
  scene.add(points);
  scene.add(line);
  
  camera.position.z = 10;
  
  let autoRotateSpeed = 0.002;
  
  function animate() {
    requestAnimationFrame(animate);
    points.rotation.y += autoRotateSpeed;
    line.rotation.y += autoRotateSpeed;
    renderer.render(scene, camera);
  }
  animate();
  
  window.addEventListener('resize', () => {
    let width = window.innerWidth;
    let height = window.innerHeight;
    renderer.setSize(width, height);
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
  });
  
  function detectColorScheme() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
  
      updateSphereColor('dark');
    } else {
  
      updateSphereColor('light');
    }
  }
  
  detectColorScheme();
  
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    const newColorScheme = e.matches ? "dark" : "light";
    updateSphereColor(newColorScheme);
  });