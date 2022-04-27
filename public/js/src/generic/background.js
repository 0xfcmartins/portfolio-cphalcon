window.onload = () => {
    const canvas = document.getElementById('canvas1');
    const context2d = canvas.getContext('2d');

    let particles = [];

    canvas.width = innerWidth;
    canvas.height = innerHeight;

    const undefinedAsZero = (value) => {
        return value === undefined || value === null ? 0 : value;
    }

    let config = {
        speed: 1,
        color: {
            edges: {
                r: 49,
                g: 49,
                b: 49
            },
            mouse: {
                r: 233,
                g: 134,
                b: 25
            }
        }
    }

    let mouse = {
        x: null,
        y: null,
        radius: (canvas.height / 80) * (canvas.width / 80)
    };

    window.addEventListener('mousemove', (event) => {
        mouse.x = event.x;
        mouse.y = event.y;
    });

    window.addEventListener('resize', () => {
        canvas.width = innerWidth;
        canvas.height = innerHeight;
        mouse.radius = (canvas.height / 80) * (canvas.width / 80);
        init();
    });

    window.addEventListener('mouseout', () => {
        mouse.x = undefined;
        mouse.y = undefined;
    });

    class Particle {
        constructor(x, y, directionX, directionY, size, color) {
            this.x = x;
            this.y = y;
            this.directionX = directionX;
            this.directionY = directionY;
            this.size = size;
            this.color = color;
            this.radius = (true ? Math.random() : 1) * 10;
        }

        draw() {
            checkOverlap(this);

            context2d.beginPath();
            context2d.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
            context2d.fillStyle = this.color;
            context2d.fill();
        }

        update() {
            if (this.x > canvas.width || this.x < 0) {
                this.directionX = -this.directionX;
            }
            if (this.y > canvas.height || this.y < 0) {
                this.directionY = -this.directionY;
            }

            this.x += this.directionX;
            this.y += this.directionY;

            this.draw();
        }
    }

    let calculateColor = function (color, alphaFactor) {
        return `rgba(${color.r},${color.g},${color.b},${1 - (alphaFactor / 20000)})`;
    }

    let drawVertice = (fromParticle, toParticle, color) => {
        context2d.strokeStyle = color;
        context2d.lineWidth = 1;
        context2d.beginPath();
        context2d.moveTo(fromParticle.x, fromParticle.y);
        context2d.lineTo(toParticle.x, toParticle.y);
        context2d.stroke();
    };

    function calculateDistance(from, to) {
        let distanceX = (from.x - to.x) * (from.x - to.x);
        let distanceY = (from.y - to.y) * (from.y - to.y);

        return (distanceX) + (distanceY);
    }

    function connectEdges() {
        for (let from = 0; from < particles.length; from++) {
            for (let to = 0; to < particles.length; to++) {
                let distance = calculateDistance(particles[from], particles[to]);
                if (distance < (canvas.width / 10) * (canvas.height / 10)) {
                    drawVertice(particles[from], particles[to], calculateColor(config.color.edges, distance));
                }
            }
        }
    }

    function connectMouse() {
        for (let from = 0; from < particles.length; from++) {
            let distance = calculateDistance(particles[from], mouse);
            if (distance < (canvas.width / 3) * (canvas.height / 3)) {
                drawVertice(particles[from], mouse, calculateColor(config.color.mouse, distance));
            }
        }
    }

    function checkOverlap(particle) {
        for (var i = 0; i < particles.length; i++) {
            var checkParticle = particles;

            var dx = particle.x - checkParticle.x,
                dy = particle.y - checkParticle.y,
                dist = Math.sqrt(dx * dx + dy * dy);

            if (dist <= particle.radius + checkParticle.radius) {
                particle.x = position ? position.x : Math.random() * canvas.width;
                particle.y = position ? position.y : Math.random() * canvas.height;
                checkOverlap(particle);
            }
        }
    };

    calculateParticles = function () {
        let area = canvas.width * canvas.height / 1000;
        let nb_particles = area * 80 / 800;

        return Math.abs(nb_particles);
    };

    function init() {
        particles = [];
        let numeberofparticles = calculateParticles();
        console.log(numeberofparticles)
        for (let i = 0; i < numeberofparticles; i++) {
            let size = (Math.random() * 2) + 1;
            let x = (Math.random() * ((innerWidth - size * 2) - (size * 2)) + size * 2);
            let y = (Math.random() * ((innerHeight - size * 2) - (size * 2)) + size * 2);
            let directionX = (Math.random() * 1.5) - 0.01;
            let directionY = (Math.random() * 1.5) - 0.01;
            let color = 'rgba(255,47,0,0.08)';

            particles.push(new Particle(x, y, directionX, directionY, size, color));
        }
    }

    function animate() {
        requestAnimationFrame(animate);
        context2d.clearRect(0, 0, canvas.width, canvas.height);

        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
        }

        connectEdges();
        connectMouse();
    }

    init();
    animate();
}