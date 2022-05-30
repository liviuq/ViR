document.addEventListener('click',e=>{
    const isDropdownButton = e.target.matches("[data-dropdown-button]")
    if(!isDropdownButton&&e.target.closest("[data-dropdown]")!=null)
    return

    let currentDropdown
    if(isDropdownButton){
    currentDropdown=e.target.closest("[data-dropdown]")
    currentDropdown.classList.toggle("active")
    }

    document.querySelectorAll("[data-dropdown].active").forEach(dropdown=>{
        if(dropdown===currentDropdown) return
        dropdown.classList.remove("active")
    })
});

const nav = document.getElementById('nav');

window.addEventListener('scroll', () => {
    if(window.scrollY > 100)
    {
        nav.classList.add('nav__black');
    }
    else
    {
        nav.classList.remove('nav__black');
    }
});