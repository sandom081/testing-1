function toggleMobileMenu() {
  const menu = document.getElementById("mobileMenu");
  if (menu.style.display === "block") {
    menu.style.display = "none";
  } else {
    menu.style.display = "block";
  }
}
function toggleMobileMenu() {
  const menu = document.getElementById("mobileMenu");
  menu.classList.toggle("active");
}
// Scroll animation
const aboutSection = document.querySelector('.about-section');
const left = document.querySelector('.about-left');
const right = document.querySelector('.about-right');

window.addEventListener('scroll', () => {
  const sectionTop = aboutSection.getBoundingClientRect().top;
  const triggerPoint = window.innerHeight / 1.2;

  if (sectionTop < triggerPoint) {
    left.style.opacity = '1';
    left.style.animationPlayState = 'running';

    right.style.opacity = '1';
    right.style.animationPlayState = 'running';
  }
});
// Animate About section when it comes into view
const leftEl = document.querySelector('.hidden-left');
const rightEl = document.querySelector('.hidden-right');

const observer = new IntersectionObserver(
  entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (entry.target.classList.contains('hidden-left')) {
          entry.target.classList.add('show-left');
        } else if (entry.target.classList.contains('hidden-right')) {
          entry.target.classList.add('show-right');
        }
      }
    });
  },
  {
    threshold: 0.3,
  }
);

observer.observe(leftEl);
observer.observe(rightEl);
// Close mobile nav on link click
document.querySelectorAll('.mobile-nav a').forEach(link => {
  link.addEventListener('click', () => {
    document.querySelector('.mobile-nav').classList.remove('active');
  });
});
const mobileNav = document.querySelector('.mobile-nav');
const hamburger = document.querySelector('.hamburger');
const closeBtn = document.querySelector('.close-nav');

hamburger.addEventListener('click', () => {
  mobileNav.classList.add('active');
  document.body.style.overflow = 'hidden';  // scroll disable
});

closeBtn.addEventListener('click', () => {
  mobileNav.classList.remove('active');
  document.body.style.overflow = '';  // scroll enable
});

// Smooth scroll to section after nav closes on link click
document.querySelectorAll('.mobile-nav a').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();  // Prevent default jump

    const targetId = link.getAttribute('href').substring(1); // remove #
    const targetSection = document.getElementById(targetId);

    // Close nav first
    mobileNav.classList.remove('active');
    document.body.style.overflow = '';

    // Wait for nav close animation to finish (if any) — else timeout 300ms safe
    setTimeout(() => {
      if (targetSection) {
        targetSection.scrollIntoView({ behavior: 'smooth' });
      }
    }, 300);  // adjust time if nav close animation time is different
  });
});

  let lastScrollY = window.scrollY;
  const header = document.querySelector('.main-header');

  window.addEventListener('scroll', () => {
    if (window.scrollY > lastScrollY) {
      // Scrolling down
      header.style.top = "-100px";
    } else {
      // Scrolling up
      header.style.top = "0";
    }
    lastScrollY = window.scrollY;
  });

