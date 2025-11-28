document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener("click", function (e) {
            var target = document.querySelector(this.getAttribute("href"));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    var hero = document.querySelector(".hero-section");
    if (hero) {
        window.addEventListener("scroll", function () {
            var offset = window.scrollY * 0.2;
            hero.style.transform = "translateY(" + offset * 0.1 + "px)";
        });
    }

    var featureCards = document.querySelectorAll(".feature-card");
    featureCards.forEach(function (card) {
        var resetTransform = function () {
            card.style.transform = "";
            card.style.boxShadow = "";
        };

        card.addEventListener("mousemove", function (e) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var centerX = rect.width / 2;
            var centerY = rect.height / 2;

            var rotateX = ((y - centerY) / centerY) * -4; // max 4deg
            var rotateY = ((x - centerX) / centerX) * 4;

            card.style.transform =
                "translateY(-10px) rotateX(" +
                rotateX.toFixed(2) +
                "deg) rotateY(" +
                rotateY.toFixed(2) +
                "deg)";
            card.style.transition =
                "transform 0.08s ease-out, box-shadow 0.15s ease-out";
            card.style.boxShadow = "0 18px 40px rgba(15, 23, 42, 0.20)";
        });

        card.addEventListener("mouseleave", function () {
            resetTransform();
        });
    });

    if ("IntersectionObserver" in window) {
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var el = entry.target;
                        el.style.opacity = "1";
                        el.style.transform = "translateY(0)";
                        el.style.transition =
                            "opacity 0.5s ease-out, transform 0.5s ease-out";
                        revealObserver.unobserve(el);
                    }
                });
            },
            {
                threshold: 0.15,
            },
        );

        var revealElements = [];
        featureCards.forEach(function (card, index) {
            card.style.opacity = "0";
            card.style.transform = "translateY(20px)";
            card.style.transition =
                "opacity 0.4s ease-out, transform 0.4s ease-out";
            card.style.transitionDelay = index * 80 + "ms";
            revealElements.push(card);
        });

        var cta = document.querySelector(".cta-content");
        if (cta) {
            cta.style.opacity = "0";
            cta.style.transform = "translateY(24px)";
            revealElements.push(cta);
        }

        revealElements.forEach(function (el) {
            revealObserver.observe(el);
        });
    }
});
