<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interactive Dot Background Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      overflow: hidden;
      background: linear-gradient(120deg, #f5f7fa 0%, #eef2f7 100%);
    }
    
    .particles-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      pointer-events: none;
    }
    
    .particle {
      position: absolute;
      border-radius: 50%;
      transform-style: preserve-3d;
      transition: transform 1s cubic-bezier(0.23, 1, 0.32, 1);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .form-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 420px;
    }
    
    .login-form {
      backdrop-filter: blur(8px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1), 0 3px 10px rgba(0,0,0,0.05);
      border: 1px solid rgba(255,255,255,0.4);
    }
    
    input::placeholder {
      color: rgba(107, 114, 128, 0.7);
    }
    
    /* Add a pulsing effect to some particles for more visual interest */
    @keyframes pulse {
      0% { transform: scale(1); opacity: 0.7; }
      50% { transform: scale(1.2); opacity: 0.9; }
      100% { transform: scale(1); opacity: 0.7; }
    }
    
    .particle.pulse {
      animation: pulse 4s infinite ease-in-out;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">
  <!-- Particle Container -->
  <div class="particles-container" id="particles"></div>
  
  <!-- Login Form -->
  <div class="form-container">
    <form action="./src/welcome.php" method="post" class="login-form bg-white bg-opacity-40 p-8 w-full rounded-2xl space-y-6">
      <h1 class="text-4xl font-bold text-center mb-8 relative">
        <span class="relative inline-block text-indigo-700">
          LOGIN
          <div class="absolute bottom-0 left-0 w-full h-1 bg-pink-400"></div>
        </span>
      </h1>
      
      <!-- Username Field -->
      <div>
        <label class="block text-sm font-medium mb-2 text-gray-700">USERNAME</label>
        <input name="username" type="text" placeholder="Enter username"
               class="w-full px-4 py-3 bg-white bg-opacity-80 text-gray-800 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent" />
      </div>
      
      <!-- Email Field -->
      <div>
        <label class="block text-sm font-medium mb-2 text-gray-700">EMAIL</label>
        <input name="email" type="email" placeholder="your@email.com"
               class="w-full px-4 py-3 bg-white bg-opacity-80 text-gray-800 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-transparent" />
      </div>
      
      <!-- Submit Button -->
      <button name="submit" type="submit"
              class="w-full py-3 px-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-600 hover:to-purple-700 transition duration-300 shadow-md">
        SUBMIT
      </button>
    </form>
  </div>

  <script>
    // Create and configure particles
    const particles = document.getElementById('particles');
    const totalParticles = 110; // More particles for better visibility
    const mouseRange = 150; // Distance at which particles react to mouse
    const moveAmount = 60; // How far particles move on hover
    
    // Mouse position tracking
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    
    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });
    
    // Colors array for the pink and purple particles
    const colors = [
      '#f472b6', // Pink-500
      '#db2777', // Pink-600
      '#a855f7', // Purple-500
      '#7c3aed', // Violet-600
      '#8b5cf6', // Violet-500
      '#ec4899', // Pink-500
      '#e879f9', // Fuchsia-400
      '#d946ef', // Fuchsia-500
      '#c084fc', // Purple-400
      '#f9a8d4', // Pink-300
    ];
    
    // Store particles for animation
    const animatedParticles = [];
    
    // Create all particles
    for (let i = 0; i < totalParticles; i++) {
      createParticle(i);
    }
    
    function createParticle(i) {
      const particle = document.createElement('div');
      particle.className = 'particle';
      
      // Random position across the screen with some margin
      const margin = 50;
      const x = margin + Math.random() * (window.innerWidth - margin * 2);
      const y = margin + Math.random() * (window.innerHeight - margin * 2);
      
      // Set base position
      particle.baseX = x;
      particle.baseY = y;
      
      // Set different sizes for particles (larger for better visibility)
      const size = 8 + Math.random() * 14;
      particle.style.width = `${size}px`;
      particle.style.height = `${size}px`;
      
      // Set varying opacity (more visible)
      particle.style.opacity = 0.4 + Math.random() * 0.5;
      
      // Set color randomly from our palette
      const colorIndex = Math.floor(Math.random() * colors.length);
      particle.style.backgroundColor = colors[colorIndex];
      
      // Add pulsing animation to some particles
      if (Math.random() > 0.7) {
        particle.classList.add('pulse');
        // Different animation delay for each pulsing particle
        particle.style.animationDelay = `${Math.random() * 4}s`;
      }
      
      // Set initial position
      updateParticlePosition(particle);
      particles.appendChild(particle);
      
      // Add to animation loop
      animatedParticles.push(particle);
    }
    
    function updateParticlePosition(particle) {
      // Calculate unique seed for this particle for varied movement
      const seed = parseFloat(particle.baseX.toString() + particle.baseY.toString());
      const time = Date.now() * 0.0003;
      
      // Create gentle floating movement with unique patterns for each particle
      const offsetX = Math.sin(time + seed * 0.1) * 30;
      const offsetY = Math.cos(time + seed * 0.2) * 30;
      
      let x = particle.baseX + offsetX;
      let y = particle.baseY + offsetY;
      
      // Calculate distance from mouse
      const distX = x - mouseX;
      const distY = y - mouseY;
      const distance = Math.sqrt(distX * distX + distY * distY);
      
      // Apply stronger repulsion when mouse is close
      if (distance < mouseRange) {
        const repulsionFactor = Math.pow((1 - distance / mouseRange), 2) * moveAmount;
        x += (distX / distance) * repulsionFactor;
        y += (distY / distance) * repulsionFactor;
      }
      
      // Keep particles within bounds with margin
      const margin = 20;
      if (x < margin) x = margin;
      if (x > window.innerWidth - margin) x = window.innerWidth - margin;
      if (y < margin) y = margin;
      if (y > window.innerHeight - margin) y = window.innerHeight - margin;
      
      // Apply final position with subtle floating effect
      particle.style.transform = `translate3d(${x}px, ${y}px, 0)`;
    }
    
    // Main animation loop with optimized rendering
    function animate() {
      // Update each particle
      animatedParticles.forEach(updateParticlePosition);
      requestAnimationFrame(animate);
    }
    
    // Start animation
    animate();
    
    // Responsive adjustments
    window.addEventListener('resize', () => {
      // Recalculate base positions on window resize
      animatedParticles.forEach((particle, i) => {
        // Keep particles distributed across the new window size
        const margin = 50;
        particle.baseX = margin + (i / totalParticles) * (window.innerWidth - margin * 2);
        particle.baseY = margin + Math.random() * (window.innerHeight - margin * 2);
        updateParticlePosition(particle);
      });
    });
  </script>
</body>
</html>