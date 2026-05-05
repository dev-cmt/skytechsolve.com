particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 36,
      "density": {
        "enable": true,
        "value_area": 1400
      }
    },
    "color": {
      "value": ["#1f4e5f", "#2a9d8f", "#e9c46a", "#e76f51"]
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 3
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.8,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 0.3,
        "opacity_min": 0.45,
        "sync": false
      }
    },
    "size": {
      "value": 7.4,
      "random": true,
      "anim": {
        "enable": true,
        "speed": 1.2,
        "size_min": 3.4,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 165,
      "color": "#000000",
      "opacity": 0.35,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 0.45,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 300,
        "rotateY": 650
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 170,
        "line_linked": {
          "opacity": 0.28
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 2
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
