//////////////////////////////////////////////////////////
// MENU START
//////////////////////////////////////////////////////////
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function () {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const header = document.getElementById('header');

  // Toggle mobile menu
  mobileMenuButton.addEventListener('click', function () {
    const isExpanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', !isExpanded);

    if (!isExpanded) {
      mobileMenu.classList.remove('scale-y-0', 'opacity-0');
      mobileMenu.classList.add('scale-y-100', 'opacity-100');
    } else {
      mobileMenu.classList.remove('scale-y-100', 'opacity-100');
      mobileMenu.classList.add('scale-y-0', 'opacity-0');
    }
  });

  // Sticky header on scroll
  window.addEventListener('scroll', function () {
    if (window.scrollY > 100) {
      header.classList.add('shadow-lg', 'bg-white/95');
    } else {
      header.classList.remove('shadow-lg', 'bg-white/95');
    }
  });

  // Close mobile menu when clicking on a link
  const mobileLinks = mobileMenu.querySelectorAll('a');
  mobileLinks.forEach(link => {
    link.addEventListener('click', function () {
      mobileMenuButton.setAttribute('aria-expanded', 'false');
      mobileMenu.classList.remove('scale-y-100', 'opacity-100');
      mobileMenu.classList.add('scale-y-0', 'opacity-0');
    });
  });

  // Close mobile menu when clicking outside
  document.addEventListener('click', function (event) {
    if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
      mobileMenuButton.setAttribute('aria-expanded', 'false');
      mobileMenu.classList.remove('scale-y-100', 'opacity-100');
      mobileMenu.classList.add('scale-y-0', 'opacity-0');
    }
  });

  // Handle escape key
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      mobileMenuButton.setAttribute('aria-expanded', 'false');
      mobileMenu.classList.remove('scale-y-100', 'opacity-100');
      mobileMenu.classList.add('scale-y-0', 'opacity-0');
    }
  });

  // Set active navigation link based on current page
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('nav a[href]:not([href="#"])');

  navLinks.forEach(link => {
    const linkPath = link.getAttribute('href');
    if (linkPath === currentPath ||
      (currentPath === '/' && linkPath === '/') ||
      (currentPath !== '/' && linkPath.includes(currentPath))) {
      link.classList.add('text-primary', 'font-semibold');
      link.classList.remove('text-gray-600', 'font-medium');
    }
  });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});
//////////////////////////////////////////////////////////
// MENU END
//////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////
// HERO
////////////////////////////////////////////////////////
// Intersection Observer for animations
document.addEventListener('DOMContentLoaded', function () {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  const animatedElements = document.querySelectorAll('[class*="animate-"]');
  animatedElements.forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });

  // Add ripple effect to CTA button
  const ctaButton = document.querySelector('a[href="#application"]');
  if (ctaButton) {
    ctaButton.addEventListener('click', function (e) {
      const ripple = document.createElement('span');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;

      ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        pointer-events: none;
                        z-index: 1;
                    `;

      this.appendChild(ripple);

      setTimeout(() => {
        ripple.remove();
      }, 600);
    });

    // Add ripple animation if not already present
    if (!document.querySelector('style[data-ripple]')) {
      const style = document.createElement('style');
      style.setAttribute('data-ripple', '');
      style.textContent = `
                        @keyframes ripple {
                            to {
                                transform: scale(4);
                                opacity: 0;
                            }
                        }
                    `;
      document.head.appendChild(style);
    }
  }

  // Handle reduced motion preferences
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.documentElement.style.setProperty('--gradient-animation', 'none');
    const animatedElements = document.querySelectorAll('[class*="animate-"]');
    animatedElements.forEach(el => {
      el.style.animation = 'none';
    });
  }
});

// Add scroll smooth behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});
/////////////////////////////////////////////////////////
// HERO END
/////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////
// ABOUT
///////////////////////////////////////////////////////
// Intersection Observer for animations
document.addEventListener('DOMContentLoaded', function () {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  const animatedElements = document.querySelectorAll('[class*="animate-"]');
  animatedElements.forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });

  // Add hover effects for cards
  const cards = document.querySelectorAll('.hover-lift');
  cards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-8px)';
    });
    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
    });
  });
});
/////////////////////////////////////////////////////////////////////
// ABOUT END
//////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
// FEATURE
////////////////////////////////////////////////////////////////////

// Intersection Observer for animations
document.addEventListener('DOMContentLoaded', function () {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  const animatedElements = document.querySelectorAll('[class*="animate-"]');
  animatedElements.forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });

  // Add hover effects for cards
  const cards = document.querySelectorAll('.card-hover');
  cards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-12px)';
    });
    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
    });
  });
});

///////////////////////////////////////////////////////////////////
// FEATURE END
///////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////
// SERVICE
//////////////////////////////////////////////////////////////////
// Intersection Observer for animations
document.addEventListener('DOMContentLoaded', function () {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  const animatedElements = document.querySelectorAll('[class*="animate-"]');
  animatedElements.forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });

  // Add hover effects for cards
  const cards = document.querySelectorAll('.card-hover');
  cards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-12px)';
    });
    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
    });
  });

  // Handle reduced motion preferences
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const animatedElements = document.querySelectorAll('[class*="animate-"]');
    animatedElements.forEach(el => {
      el.style.animation = 'none';
    });
  }
});
///////////////////////////////////////////////////////////////////////
// SERVICE END
//////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
// PRICE
/////////////////////////////////////////////////////////////////////////
// Loan Plans Data
const plans = [{
  name: "Starter Plan",
  icon: "fas fa-seedling",
  description: "Perfect for testing new marketing channels or small campaigns",
  amount: {
    short: "$5,000",
    long: "$15,000"
  },
  term: {
    short: "6-12 months",
    long: "2-3 years"
  },
  rate: {
    short: "8.5% APR",
    long: "9.2% APR"
  },
  note: "Fast approval within 24 hours",
  buttonUrl: "#apply",
  buttonText: "Apply Now",
  buttonAriaLabel: "Apply for Starter Plan",
  features: [{
    text: "No collateral required",
    icon: "fas fa-shield-check"
  },
  {
    text: "Digital application process",
    icon: "fas fa-mobile-alt"
  },
  {
    text: "Flexible repayment options",
    icon: "fas fa-calendar-alt"
  }
  ],
  featured: false
},
{
  name: "Growth Accelerator",
  icon: "fas fa-chart-line",
  description: "Ideal for scaling successful campaigns and expanding reach",
  amount: {
    short: "$25,000",
    long: "$75,000"
  },
  term: {
    short: "12-24 months",
    long: "3-5 years"
  },
  rate: {
    short: "7.2% APR",
    long: "7.8% APR"
  },
  note: "Most popular choice",
  buttonUrl: "#apply",
  buttonText: "Get Started",
  buttonAriaLabel: "Apply for Growth Accelerator",
  features: [{
    text: "Higher funding limits",
    icon: "fas fa-money-bill-wave"
  },
  {
    text: "Extended repayment terms",
    icon: "fas fa-clock"
  },
  {
    text: "Dedicated account manager",
    icon: "fas fa-user-tie"
  },
  {
    text: "Marketing consultation",
    icon: "fas fa-lightbulb"
  }
  ],
  featured: true
},
{
  name: "Enterprise Scale",
  icon: "fas fa-rocket",
  description: "For large-scale marketing initiatives and market expansion",
  amount: {
    short: "$75,000",
    long: "$200,000"
  },
  term: {
    short: "24-36 months",
    long: "5-7 years"
  },
  rate: {
    short: "6.5% APR",
    long: "6.9% APR"
  },
  note: "Customized solutions available",
  buttonUrl: "#apply",
  buttonText: "Contact Sales",
  buttonAriaLabel: "Apply for Enterprise Scale",
  features: [{
    text: "Maximum funding capacity",
    icon: "fas fa-trophy"
  },
  {
    text: "Tailored repayment plans",
    icon: "fas fa-cogs"
  },
  {
    text: "Priority customer support",
    icon: "fas fa-headset"
  },
  {
    text: "Strategic planning session",
    icon: "fas fa-chess"
  }
  ],
  featured: false
}
];

// Render Pricing Table
function renderPricingTable(loanType = 'short') {
  const table = document.getElementById('pricing-table');
  const loanDescription = document.getElementById('loan-description');

  // Update description based on loan type
  if (loanType === 'short') {
    loanDescription.textContent = "Perfect for seasonal campaigns and short-term projects";
  } else {
    loanDescription.textContent = "Ideal for long-term growth strategies and business expansion";
  }

  table.innerHTML = plans.map((plan, index) => {
    const animationDelay = `${0.2 * (index + 1)}s`;
    const isFeatured = plan.featured;

    return `
                    <div class="pricing-card bg-white rounded-2xl p-8 card-hover animate-fadeInUp ${isFeatured ? 'featured-card animate-pulse-glow' : ''}" 
                         style="animation-delay: ${animationDelay}">
                        ${isFeatured ? '<div class="loan-badge">MOST POPULAR</div>' : ''}
                        
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <i class="${plan.icon} text-2xl ${isFeatured ? 'text-primary-500' : 'text-primary-700'}"></i>
                                    <h4 class="text-2xl font-bold ${isFeatured ? 'text-primary-500' : 'text-primary-700'}">${plan.name}</h4>
                                </div>
                                <p class="text-gray-600">${plan.description}</p>
                            </div>
                        </div>
                        
                        <div class="mb-6 p-4 bg-gradient-to-r ${isFeatured ? 'from-primary-50 to-accent-50' : 'from-gray-50 to-gray-100'} rounded-lg">
                            <div class="text-4xl font-bold ${isFeatured ? 'text-primary-500' : 'text-primary-700'} mb-1">
                                ${loanType === 'short' ? plan.amount.short : plan.amount.long}
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">${loanType === 'short' ? plan.term.short : plan.term.long}</span>
                                <span class="text-sm font-semibold ${isFeatured ? 'text-primary-500' : 'text-primary-700'}">
                                    ${loanType === 'short' ? plan.rate.short : plan.rate.long}
                                </span>
                            </div>
                        </div>
                        
                        <p class="text-sm ${isFeatured ? 'text-primary-500' : 'text-primary-700'} font-semibold mb-6 text-center">${plan.note}</p>
                        
                        <a href="${plan.buttonUrl}" 
                           class="block w-full py-3 ${isFeatured ? 'bg-primary-500 hover:bg-primary-600' : 'bg-primary-700 hover:bg-primary-800'} text-white font-semibold rounded-lg transition-all duration-300 text-center mb-6 hover:shadow-lg" 
                           aria-label="${plan.buttonAriaLabel}">
                            ${plan.buttonText}
                        </a>
                        
                        <ul class="space-y-4">
                            ${plan.features.map(feature => `
                                    <li class="flex items-center gap-3 text-gray-700">
                                        <i class="${feature.icon} ${isFeatured ? 'text-primary-500' : 'text-primary-700'}"></i>
                                        <span>${feature.text}</span>
                                    </li>
                                `).join('')}
                        </ul>
                    </div>
                `;
  }).join('');
}

// Initialize and Toggle Loan Type
document.addEventListener('DOMContentLoaded', () => {
  let loanType = 'short';
  renderPricingTable(loanType);

  const switcher = document.getElementById('loan-type-switcher');

  switcher.addEventListener('click', () => {
    loanType = loanType === 'short' ? 'long' : 'short';
    switcher.classList.toggle('active');

    // Update toggle text
    const knob = switcher.querySelector('.toggle-knob');
    knob.textContent = loanType === 'short' ? 'S' : 'L';

    renderPricingTable(loanType);
  });
});
///////////////////////////////////////////////////////////////////////////
// PRICE END
///////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////
// TEAM
//////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  const track = document.querySelector('.carousel-track');
  const slides = Array.from(document.querySelectorAll('.carousel-slide'));
  const prevButton = document.querySelector('.carousel-prev');
  const nextButton = document.querySelector('.carousel-next');
  const indicators = document.querySelectorAll('.carousel-indicator');

  let currentIndex = 0;
  const slideWidth = slides[0].offsetWidth + 24; // 24px is the gap
  const slidesPerView = Math.floor(track.parentElement.offsetWidth / slideWidth);

  // Set initial position
  updateCarousel();

  // Next button event
  nextButton.addEventListener('click', () => {
    if (currentIndex < slides.length - slidesPerView) {
      currentIndex++;
      updateCarousel();
    }
  });

  // Previous button event
  prevButton.addEventListener('click', () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateCarousel();
    }
  });

  // Indicator events
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      currentIndex = index;
      updateCarousel();
    });
  });

  // Update carousel position and indicators
  function updateCarousel() {
    const translateX = -currentIndex * slideWidth;
    track.style.transform = `translateX(${translateX}px)`;

    // Update indicators
    indicators.forEach((indicator, index) => {
      if (index === currentIndex) {
        indicator.classList.add('active');
        indicator.classList.remove('bg-gray-300');
        indicator.classList.add('bg-primary-700');
      } else {
        indicator.classList.remove('active');
        indicator.classList.add('bg-gray-300');
        indicator.classList.remove('bg-primary-700');
      }
    });

    // Update button states
    prevButton.classList.toggle('opacity-50', currentIndex === 0);
    prevButton.classList.toggle('cursor-not-allowed', currentIndex === 0);

    nextButton.classList.toggle('opacity-50', currentIndex >= slides.length - slidesPerView);
    nextButton.classList.toggle('cursor-not-allowed', currentIndex >= slides.length - slidesPerView);
  }

  // Handle window resize
  window.addEventListener('resize', () => {
    updateCarousel();
  });

  // Auto-advance carousel (optional)
  let autoAdvance = setInterval(() => {
    if (currentIndex < slides.length - slidesPerView) {
      currentIndex++;
    } else {
      currentIndex = 0;
    }
    updateCarousel();
  }, 5000);

  // Pause auto-advance on hover
  track.addEventListener('mouseenter', () => {
    clearInterval(autoAdvance);
  });

  track.addEventListener('mouseleave', () => {
    autoAdvance = setInterval(() => {
      if (currentIndex < slides.length - slidesPerView) {
        currentIndex++;
      } else {
        currentIndex = 0;
      }
      updateCarousel();
    }, 5000);
  });
});
////////////////////////////////////////////////////////////////////////////
/// TEAM END
//////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////
// PROJECT
//////////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  // Tab functionality
  const allTab = document.getElementById('tab-all');
  const marketingTab = document.getElementById('tab-marketing');
  const ecommerceTab = document.getElementById('tab-ecommerce');
  const startupTab = document.getElementById('tab-startup');
  const tabs = [allTab, marketingTab, ecommerceTab, startupTab];
  const projects = document.querySelectorAll('.story-card');

  // Set up tab click handlers
  tabs.forEach(tab => {
    tab.addEventListener('click', function () {
      // Remove active class from all tabs
      tabs.forEach(t => {
        t.classList.remove('tab-active');
        t.classList.add('bg-transparent', 'text-primary-700', 'border-2',
          'border-primary-700');
        t.classList.remove('bg-primary-500', 'text-white');
      });

      // Add active class to clicked tab
      this.classList.add('tab-active');
      this.classList.remove('bg-transparent', 'text-primary-700', 'border-2',
        'border-primary-700');
      this.classList.add('bg-primary-500', 'text-white');

      // Filter projects based on tab
      const filter = this.id.replace('tab-', '');
      filterProjects(filter);
    });
  });

  // Filter projects function
  function filterProjects(category) {
    projects.forEach(project => {
      if (category === 'all') {
        project.style.display = 'block';
      } else {
        const projectCategory = project.querySelector('.text-accent-500').textContent
          .toLowerCase();
        if (projectCategory.includes(category)) {
          project.style.display = 'block';
        } else {
          project.style.display = 'none';
        }
      }
    });
  }

  // Add hover effects to story cards
  projects.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-8px)';
      this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
    });
  });
});
/////////////////////////////////////////////////////////////////////
// PROJECT END
////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////
// TESTIMONIAL
////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  // Initialize Swiper
  const testimonialSlider = new Swiper('.testimonial-slider', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      }
    },
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
    },
    effect: 'slide',
    speed: 800
  });

  // Pause autoplay on hover
  const sliderContainer = document.querySelector('.testimonial-slider');
  sliderContainer.addEventListener('mouseenter', () => {
    testimonialSlider.autoplay.stop();
  });
  sliderContainer.addEventListener('mouseleave', () => {
    testimonialSlider.autoplay.start();
  });

  // Video play button functionality
  const playButton = document.querySelector('.play-button');
  playButton.addEventListener('click', function () {
    alert(
      'Video testimonial would play here. In a real implementation, this would trigger a video modal or embedded player.'
    );
  });

  // Add hover effects to testimonial cards
  const testimonialCards = document.querySelectorAll('.testimonial-card');
  testimonialCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-8px)';
      this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
    });
  });

  // Add hover effects to stats cards
  const statsCards = document.querySelectorAll('.stats-card');
  statsCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'scale(1.05)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'scale(1)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
    });
  });
});
//////////////////////////////////////////////////////////////////////
// TESTIMONIAL
///////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
// COUNTER
//////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  // Animated counters
  const counters = document.querySelectorAll('.counter');
  const speed = 200; // The lower the slower

  const animateCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    const count = +counter.innerText;
    const inc = target / speed;

    if (count < target) {
      counter.innerText = Math.ceil(count + inc);
      setTimeout(() => animateCounter(counter), 10);
    } else {
      counter.innerText = target;
    }
  };

  // Intersection Observer for counter animation
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5
  });

  counters.forEach(counter => {
    observer.observe(counter);
  });

  // Add hover effects to stat cards
  const statCards = document.querySelectorAll('.stat-card');
  statCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-8px)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
    });
  });

  // Add click effects to CTA buttons
  const ctaButtons = document.querySelectorAll('a[href*="#"]');
  ctaButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      if (this.getAttribute('href').startsWith('#')) {
        e.preventDefault();
        // In a real implementation, this would scroll to the section
        alert('This would navigate to the ' + this.getAttribute('href') +
          ' section');
      }
    });
  });
});
/////////////////////////////////////////////////////////////////////
// COUNTER END
////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
// CLIENT
///////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  // Initialize Swiper
  const clientsSwiper = new Swiper('.clients-swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
      1280: {
        slidesPerView: 4,
      }
    },
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    effect: 'slide',
    speed: 600
  });

  // Add hover effects to client cards
  const clientCards = document.querySelectorAll('.client-card');
  clientCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-8px)';
      this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
    });
  });

  // Add hover effects to highlight cards
  const highlightCards = document.querySelectorAll('.highlight-card');
  highlightCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-5px)';
      this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
    });
  });

  // Add hover effects to industry badges
  const industryBadges = document.querySelectorAll('.industry-badge');
  industryBadges.forEach(badge => {
    badge.addEventListener('mouseenter', function () {
      this.style.transform = 'scale(1.05)';
    });

    badge.addEventListener('mouseleave', function () {
      this.style.transform = 'scale(1)';
    });
  });

  // Smooth scroll for CTA buttons
  const ctaButtons = document.querySelectorAll('a[href*="#"]');
  ctaButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      if (this.getAttribute('href').startsWith('#')) {
        e.preventDefault();
        // In a real implementation, this would scroll to the section
        alert('This would navigate to the ' + this.getAttribute('href') +
          ' section');
      }
    });
  });

  // Pause autoplay on hover
  const swiperContainer = document.querySelector('.clients-swiper');
  swiperContainer.addEventListener('mouseenter', () => {
    clientsSwiper.autoplay.stop();
  });
  swiperContainer.addEventListener('mouseleave', () => {
    clientsSwiper.autoplay.start();
  });
});
/////////////////////////////////////////////////////////////////////
/// CLIENT END
///////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
// CONTACT
//////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loanApplicationForm');
  const submitBtn = document.getElementById('submitBtn');
  const formMessage = document.getElementById('formMessage');

  // Phone number formatting
  const phoneInput = document.getElementById('phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function (e) {
      const value = e.target.value.replace(/\D/g, '');
      if (value.length <= 10) {
        e.target.value = formatPhoneNumber(value);
      }
    });
  }

  function formatPhoneNumber(phoneNumber) {
    const cleaned = ('' + phoneNumber).replace(/\D/g, '');
    const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
    if (match) {
      return '(' + match[1] + ') ' + match[2] + '-' + match[3];
    }
    return phoneNumber;
  }

  // Form submission
  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    // Validate required fields
    if (!data.fullname || !data.email || !data.businessType || !data.loanAmount || !data
      .loanPurpose) {
      showMessage('Please fill in all required fields.', 'error');
      return;
    }

    // Validate email format
    if (!isValidEmail(data.email)) {
      showMessage('Please enter a valid email address.', 'error');
      return;
    }

    // Show loading state
    setLoadingState(true);

    // Simulate API call (replace with actual API call)
    setTimeout(() => {
      // Simulate successful submission
      showMessage(
        'Application submitted successfully! Our team will contact you within 24 hours.',
        'success');
      form.reset();
      setLoadingState(false);

      // Show success animation
      showSuccessAnimation();
    }, 2000);
  });

  function showMessage(message, type) {
    formMessage.textContent = message;
    formMessage.className = `p-4 rounded-lg mb-4 ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' :
      type === 'error' ? 'bg-red-100 text-red-700 border border-red-200' :
        'bg-blue-100 text-blue-700 border border-blue-200'
      }`;
    formMessage.classList.remove('hidden');

    // Auto-hide success messages after 5 seconds
    if (type === 'success') {
      setTimeout(() => {
        formMessage.classList.add('hidden');
      }, 5000);
    }
  }

  function setLoadingState(loading) {
    if (loading) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
      submitBtn.classList.remove('animate-pulse-glow');
    } else {
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Application';
      submitBtn.classList.add('animate-pulse-glow');
    }
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  function showSuccessAnimation() {
    // In a real implementation, this would show a more elaborate success animation
    submitBtn.innerHTML = '<i class="fas fa-check success-checkmark"></i> Application Submitted!';
    submitBtn.classList.remove('bg-accent-500', 'hover:bg-accent-600');
    submitBtn.classList.add('bg-green-500', 'hover:bg-green-600');

    setTimeout(() => {
      submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Another Application';
      submitBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
      submitBtn.classList.add('bg-accent-500', 'hover:bg-accent-600');
    }, 3000);
  }

  // Add hover effects to contact cards
  const contactCards = document.querySelectorAll('.contact-card');
  contactCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-5px)';
      this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
      this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
    });
  });
});
////////////////////////////////////////////////////////////////////
// CONTACT END
/////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
// FOOTER
/////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', function () {
  // Scroll to top functionality
  const scrollTopBtn = document.getElementById('scrollTopBtn');

  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      scrollTopBtn.classList.remove('hidden');
      scrollTopBtn.classList.add('animate-fadeIn');
    } else {
      scrollTopBtn.classList.add('hidden');
    }
  });

  scrollTopBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  // Newsletter form handling
  const newsletterForm = document.getElementById('newsletterForm');
  const newsletterMessage = document.getElementById('newsletterMessage');

  if (newsletterForm) {
    newsletterForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(newsletterForm);
      const email = formData.get('email').trim();
      const submitButton = newsletterForm.querySelector('button[type="submit"]');
      const originalButtonText = submitButton.innerHTML;

      // Basic validation
      if (!email) {
        showNewsletterMessage('Please enter your email address.', 'error');
        return;
      }

      if (!isValidEmail(email)) {
        showNewsletterMessage('Please enter a valid email address.', 'error');
        return;
      }

      // Show loading state
      submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
      submitButton.disabled = true;
      showNewsletterMessage('Subscribing to newsletter...', 'info');

      try {
        // Simulate API call (replace with actual API call)
        await new Promise(resolve => setTimeout(resolve, 1500));

        // Simulate successful subscription
        showNewsletterMessage(
          'Thank you for subscribing! You will receive our next newsletter.',
          'success');
        newsletterForm.reset();

        // Reset button after success
        setTimeout(() => {
          submitButton.innerHTML = originalButtonText;
          submitButton.disabled = false;
          showNewsletterMessage('', 'success');
        }, 3000);

      } catch (error) {
        showNewsletterMessage('Subscription failed. Please try again.', 'error');
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;
      }
    });
  }

  function showNewsletterMessage(message, type) {
    if (!newsletterMessage) return;

    newsletterMessage.textContent = message;
    newsletterMessage.className = 'mt-4 text-sm min-h-6 transition-all duration-300 ';

    if (type === 'error') {
      newsletterMessage.classList.add('text-red-300');
    } else if (type === 'success') {
      newsletterMessage.classList.add('text-green-300');
    } else if (type === 'info') {
      newsletterMessage.classList.add('text-accent-300');
    }
  }

  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Add hover effects to footer cards
  const footerCards = document.querySelectorAll('.footer-card');
  footerCards.forEach(card => {
    card.addEventListener('mouseenter', function () {
      this.style.transform = 'translateY(-5px)';
    });

    card.addEventListener('mouseleave', function () {
      this.style.transform = 'translateY(0)';
    });
  });

  // Add click animation to social icons
  const socialIcons = document.querySelectorAll('.social-icon');
  socialIcons.forEach(icon => {
    icon.addEventListener('click', function (e) {
      e.preventDefault();
      this.style.transform = 'scale(0.9)';
      setTimeout(() => {
        this.style.transform = 'scale(1.1) rotate(5deg)';
      }, 150);
    });
  });
});
/////////////////////////////////////////////////////////////////////
// FOOTER END
/////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
// CALCULATOR
/////////////////////////////////////////////////////////////////////
// Initialize calculator functionality
document.addEventListener('DOMContentLoaded', function () {
  const calc = @json($calc);
  const loanAmount = document.getElementById('loanAmount');
  const interestRate = document.getElementById('interestRate');
  const loanTerm = document.getElementById('loanTerm');
  const termTypeBtns = document.querySelectorAll('.term-type-btn');
  const scheduleBtns = document.querySelectorAll('.schedule-btn');
  const calculateBtn = document.getElementById('calculateBtn');
  const resetBtn = document.getElementById('resetBtn');
  const resultPanel = document.getElementById('resultPanel');
  const noResult = document.getElementById('noResult');

  let termType = 'days';
  let paymentDays = 3;

  // Update term slider based on type
  termTypeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      termTypeBtns.forEach(b => b.classList.remove('active', 'bg-gradient-to-br',
        'from-secondary-secondary', 'to-accent-accent', 'text-white'));
      termTypeBtns.forEach(b => b.classList.add('bg-gray-100', 'text-gray-600'));
      btn.classList.add('active', 'bg-gradient-to-br', 'from-secondary-secondary',
        'to-accent-accent', 'text-white');
      btn.classList.remove('bg-gray-100', 'text-gray-600');
      termType = btn.dataset.type;

      const min = termType === 'days' ? calc.min_days : calc.min_months;
      const max = termType === 'days' ? calc.max_days : calc.max_months;
      const def = termType === 'days' ? calc.default_days : calc.default_months;

      loanTerm.min = min;
      loanTerm.max = max;
      loanTerm.value = def;

      document.getElementById('termMin').textContent = min + ' ' + termType;
      document.getElementById('termMax').textContent = max + ' ' + termType;
      updateTermDisplay();
    });
  });

  scheduleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      scheduleBtns.forEach(b => b.classList.remove('active', 'bg-gradient-to-br',
        'from-secondary-secondary', 'to-accent-accent', 'text-white'));
      scheduleBtns.forEach(b => b.classList.add('bg-gray-100', 'text-gray-600'));
      btn.classList.add('active', 'bg-gradient-to-br', 'from-secondary-secondary',
        'to-accent-accent', 'text-white');
      btn.classList.remove('bg-gray-100', 'text-gray-600');
      paymentDays = parseInt(btn.dataset.days);
    });
  });

  function updateTermDisplay() {
    const value = loanTerm.value;
    const unit = termType === 'days' ? 'days' : 'months';
    document.getElementById('loanTermValue').textContent = value;
    document.getElementById('termUnit').textContent = unit;
  }

  loanTerm.addEventListener('input', updateTermDisplay);

  // Format number
  function formatZMW(amount) {
    return new Intl.NumberFormat('en-ZM', {
      style: 'currency',
      currency: 'ZMW',
      minimumFractionDigits: 0
    }).format(amount).replace('ZMW', 'ZMW');
  }

  // Calculate
  function calculate() {
    const principal = parseFloat(loanAmount.value);
    const rate = parseFloat(interestRate.value) / 100;
    const termDays = termType === 'days' ? parseInt(loanTerm.value) : parseInt(loanTerm.value) * 30;
    const totalInterest = principal * rate * (termDays / 365);
    const totalAmount = principal + totalInterest;
    const paymentsPerWeek = paymentDays;
    const totalWeeks = Math.ceil(termDays / 7);
    const totalPayments = totalWeeks * paymentsPerWeek;
    const paymentPerInstallment = totalAmount / totalPayments;

    // Update UI
    document.getElementById('paymentAmount').textContent = formatZMW(paymentPerInstallment);
    document.getElementById('paymentScheduleText').textContent =
      `${paymentsPerWeek} payments per week for ${totalWeeks} weeks`;
    document.getElementById('totalPrincipal').textContent = formatZMW(principal);
    document('totalInterest').textContent = formatZMW(totalInterest);

    const principalPct = Math.round((principal / totalAmount) * 100);
    const interestPct = 100 - principalPct;
    document.getElementById('principalPercent').textContent = principalPct + '%';
    document.getElementById('interestPercent').textContent = interestPct + '%';
    document.getElementById('principalBar').style.width = principalPct + '%';
    document.getElementById('interestBar').style.width = interestPct + '%';

    // Payment dates
    const today = new Date();
    const next = new Date(today);
    next.setDate(today.getDate() + Math.ceil((7 - today.getDay() + 1) / paymentDays) * paymentDays);
    const following = new Date(next);
    following.setDate(next.getDate() + (7 / paymentDays));

    document.getElementById('nextPayment').textContent = next.toLocaleDateString('en-GB', {
      weekday: 'short',
      day: 'numeric',
      month: 'short'
    });
    document.getElementById('followingPayment').textContent = following.toLocaleDateString('en-GB', {
      weekday: 'short',
      day: 'numeric',
      month: 'short'
    });

    resultPanel.classList.remove('hidden');
    noResult.classList.add('hidden');
  }

  calculateBtn.addEventListener('click', calculate);
  resetBtn.addEventListener('click', () => {
    location.reload();
  });

  // Live updates
  loanAmount.addEventListener('input', () => {
    document.getElementById('loanAmountValue').textContent = Number(loanAmount.value)
      .toLocaleString();
  });
  interestRate.addEventListener('input', () => {
    document.getElementById('interestRateValue').textContent = interestRate.value;
  });

  // Initialize
  document.getElementById('loanAmountValue').textContent = Number(calc.default_amount).toLocaleString();
  document.getElementById('interestRateValue').textContent = calc.default_rate;
  updateTermDisplay();
});
///////////////////////////////////////////////////////////////////////////////
// CALCULATOR
///////////////////////////////////////////////////////////////////////////////