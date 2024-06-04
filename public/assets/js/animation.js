
const animeElements = document.querySelectorAll('.animated');

const options = {
    threshold: 0.8
};
const callback = (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            var animationType=entry.target.dataset.type
            var animationDuration=entry.target.dataset.duration
            var animationDelay=entry.target.dataset.delay
            entry.target.style.animation=`${animationType} ${animationDuration}s ${animationDelay}s forwards`
            console.log(animationType,animationDuration,animationDelay)
            observer.unobserve(entry.target)
        }
    });
};

// Créer un nouvel observateur avec la fonction de rappel et les options
const observer = new IntersectionObserver(callback, options);

// Observer chaque élément avec la classe .anime
animeElements.forEach(element => {
    observer.observe(element);
});

