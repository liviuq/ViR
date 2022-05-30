window.addEventListener('scroll', () => {
    if(window.scrollY > 100)
    {
        document.getElementById('nav').classList.add('nav__black');
    }
    else
    {
        document.getElementById('nav').classList.remove('nav__black');
    }
});