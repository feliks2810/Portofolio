import './bootstrap';

// ── Particle Background ──────────────────────────────────────────────────────
function initParticles() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let particles = [];
    const resize = () => { canvas.width = canvas.offsetWidth; canvas.height = canvas.offsetHeight; };
    resize();
    window.addEventListener('resize', resize);
    for (let i = 0; i < 60; i++) {
        particles.push({ x: Math.random() * canvas.width, y: Math.random() * canvas.height, r: Math.random() * 1.5 + 0.5, dx: (Math.random() - .5) * .4, dy: (Math.random() - .5) * .4, o: Math.random() * .4 + .1 });
    }
    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(96,165,250,${p.o})`; ctx.fill();
            p.x += p.dx; p.y += p.dy;
            if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
            if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
        });
        // draw connections
        particles.forEach((a, i) => particles.slice(i+1).forEach(b => {
            const d = Math.hypot(a.x-b.x, a.y-b.y);
            if (d < 120) {
                ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y);
                ctx.strokeStyle = `rgba(96,165,250,${.08*(1-d/120)})`; ctx.lineWidth = .5; ctx.stroke();
            }
        }));
        requestAnimationFrame(draw);
    }
    draw();
}

// ── Typing Animation ─────────────────────────────────────────────────────────
function initTyping() {
    const el = document.getElementById('typing-text');
    if (!el) return;
    const roles = el.dataset.roles ? el.dataset.roles.split(',') : ['Developer'];
    let ri = 0, ci = 0, deleting = false;
    function tick() {
        const word = roles[ri];
        el.textContent = deleting ? word.substring(0, ci--) : word.substring(0, ci++);
        let delay = deleting ? 60 : 100;
        if (!deleting && ci > word.length) { delay = 2000; deleting = true; }
        else if (deleting && ci < 0) { deleting = false; ri = (ri + 1) % roles.length; ci = 0; delay = 400; }
        setTimeout(tick, delay);
    }
    tick();
}

// ── Scroll Animations ────────────────────────────────────────────────────────
function initScrollAnimations() {
    const els = document.querySelectorAll('[data-animate]');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('animate-fade-up'); e.target.style.opacity = '1'; obs.unobserve(e.target); } });
    }, { threshold: 0.1 });
    els.forEach(el => { el.style.opacity = '0'; obs.observe(el); });
}

// ── Progress Bars ────────────────────────────────────────────────────────────
function initProgressBars() {
    const bars = document.querySelectorAll('.progress-fill[data-level]');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.style.width = e.target.dataset.level + '%'; obs.unobserve(e.target); } });
    }, { threshold: 0.3 });
    bars.forEach(bar => { bar.style.width = '0%'; obs.observe(bar); });
}

// ── Count Up ─────────────────────────────────────────────────────────────────
function initCountUp() {
    const els = document.querySelectorAll('[data-count]');
    const obs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (!e.isIntersecting) return;
            const el = e.target, target = parseFloat(el.dataset.count), decimals = el.dataset.decimals || 0;
            let start = 0, step = target / 60;
            const timer = setInterval(() => {
                start = Math.min(start + step, target);
                el.textContent = decimals ? start.toFixed(decimals) : Math.floor(start);
                if (start >= target) clearInterval(timer);
            }, 16);
            obs.unobserve(el);
        });
    }, { threshold: 0.3 });
    els.forEach(el => obs.observe(el));
}

// ── Project Modal ─────────────────────────────────────────────────────────────
window.openProjectModal = function(data) {
    const modal = document.getElementById('project-modal');
    if (!modal) return;
    document.getElementById('modal-title').textContent = data.title || '';
    document.getElementById('modal-category').textContent = data.category || '';
    document.getElementById('modal-description').textContent = data.long_description || data.description || '';
    const stack = document.getElementById('modal-stack');
    stack.innerHTML = (data.tech_stack || []).map(t => `<span class="tag">${t}</span>`).join('');
    const features = document.getElementById('modal-features');
    features.innerHTML = (data.features || []).map(f => `<li class="flex gap-2 text-sm text-gray-300"><span class="text-blue-400 mt-0.5">✓</span>${f}</li>`).join('');
    const img = document.getElementById('modal-image');
    img.src = data.thumbnail || '';
    img.style.display = data.thumbnail ? 'block' : 'none';
    const demoBtn = document.getElementById('modal-demo');
    const githubBtn = document.getElementById('modal-github');
    if (demoBtn) { demoBtn.href = data.demo_url || '#'; demoBtn.style.display = data.demo_url ? 'inline-flex' : 'none'; }
    if (githubBtn) { githubBtn.href = data.github_url || '#'; githubBtn.style.display = data.github_url ? 'inline-flex' : 'none'; }
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
window.closeProjectModal = function() {
    const modal = document.getElementById('project-modal');
    if (modal) modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Contact Form ──────────────────────────────────────────────────────────────
function initContactForm() {
    const form = document.getElementById('contact-form');
    if (!form) return;
    form.addEventListener('submit', async e => {
        e.preventDefault();
        const btn = form.querySelector('button[type="submit"]');
        const msg = document.getElementById('form-message');
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Sending...';
        try {
            const res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
            const data = await res.json();
            if (res.ok && data.success) {
                msg.className = 'mt-3 p-3 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm';
                msg.textContent = data.message;
                form.reset();
            } else if (res.status === 422) {
                msg.className = 'mt-3 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm';
                msg.textContent = Object.values(data.errors)[0][0];
            } else {
                msg.className = 'mt-3 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm';
                msg.textContent = data.message || 'Something went wrong. Please try again.';
            }
        } catch { msg.className = 'mt-3 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm'; msg.textContent = 'Network error. Please try again.'; }
        finally { btn.disabled = false; btn.innerHTML = 'Send Message'; }
    });
}

// ── Testimonial Slider ────────────────────────────────────────────────────────
function initTestimonialSlider() {
    const container = document.getElementById('testimonial-slider');
    if (!container) return;
    const items = container.querySelectorAll('.testimonial-item');
    if (items.length === 0) return;
    let current = 0;
    const show = i => {
        items.forEach((item, idx) => {
            item.style.opacity = idx === i ? '1' : '0';
            item.style.transform = idx === i ? 'translateX(0)' : 'translateX(20px)';
            item.style.position = idx === i ? 'relative' : 'absolute';
            item.style.pointerEvents = idx === i ? 'auto' : 'none';
        });
    };
    show(0);
    if (items.length <= 1) return;
    setInterval(() => { current = (current + 1) % items.length; show(current); }, 5000);
}

document.addEventListener('DOMContentLoaded', () => {
    initParticles();
    initTyping();
    initScrollAnimations();
    initProgressBars();
    initCountUp();
    initContactForm();
    initTestimonialSlider();
});
