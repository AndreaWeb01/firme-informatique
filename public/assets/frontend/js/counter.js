const counters = document.querySelectorAll('.counter');
let hasAnimated = false;

const animateCounters = () => {
  counters.forEach(counter => {
    const target = +counter.getAttribute('data-target');
    let current = 1; // commence à 1
    counter.innerText = `+${current}`;

    const updateCount = () => {
      if (current < target) {
        current++;
        counter.innerText = `+${current}`;
        setTimeout(updateCount, 20); // vitesse de défilement
      } else {
        counter.innerText = `+${target}`;
      }
    };

    counter.classList.add('visible');
    updateCount();
  });
};

const observer = new IntersectionObserver(entries => {
  const entry = entries[0];
  if (entry.isIntersecting && !hasAnimated) {
    animateCounters();
    hasAnimated = true;
    observer.disconnect();
  }
}, { threshold: 0.5 });

observer.observe(document.querySelector('.statist'));
