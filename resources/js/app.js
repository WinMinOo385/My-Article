document.addEventListener('DOMContentLoaded', function() {
    const themes = [
        'light', 'dark', 'dim', 'retro','caramellatte', 'cyberpunk', 'lofi', 'cupcake', 'dracula', 
        'business', 'valentine', 'halloween', 'garden', 'forest', 'aqua', 'black', 
        'luxury', 'night', 'winter', 'sunset', 'emerald', 'corporate', 'synthwave', 'mocha', 'barbie', 'blood', 'lemonade',
    ];
    
    const themeNames = {
        'light': 'Light',
        'dark': 'Dark',
        'dim': 'Dim',
        'retro': 'Retro',
        'caramellatte': 'Caramellatte',
        'cyberpunk': 'Cyberpunk',
        'lofi': 'Lofi',
        'cupcake': 'Cupcake',
        'dracula': 'Dracula',
        'business': 'Business',
        'valentine': 'Valentine',
        'halloween': 'Halloween',
        'garden': 'Garden',
        'forest': 'Forest',
        'aqua': 'Aqua',
        'black': 'Black',
        'luxury': 'Luxury',
        'night': 'Night',
        'winter': 'Winter',
        'sunset': 'Sunset',
        'emerald': 'Emerald',
        'corporate': 'Corporate',
        'synthwave': 'Synthwave',
        'mocha': 'Mocha',
        'barbie': 'Barbie',
        'blood': 'Blood',
        'lemonade': 'Lemonade',
    };
    
    let currentTheme = localStorage.getItem('theme') || 'dim';
    
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    const currentThemeDisplay = document.getElementById('current-theme');
    const themeDropdown = document.getElementById('theme-dropdown');
    
    if (currentThemeDisplay && themeDropdown) {
        currentThemeDisplay.textContent = themeNames[currentTheme] || currentTheme;
        
        themes.forEach(theme => {
            const li = document.createElement('li');
            
            const input = document.createElement('input');
            input.type = 'radio';
            input.name = 'theme-dropdown';
            input.className = 'theme-controller w-full btn btn-sm btn-block  btn-ghost justify-start';
            input.setAttribute('aria-label', themeNames[theme]);
            input.value = theme;
            
            if (currentTheme === theme) {
                input.checked = true;
            }
            
            const labelText = document.createTextNode(themeNames[theme]);
            
            input.appendChild(labelText);
            
            li.appendChild(input);
            
            input.addEventListener('change', (e) => {
                e.preventDefault();
                if (e.target.checked) {
                    setTheme(theme);
                    currentThemeDisplay.textContent = themeNames[theme];
                }
            });
            
            themeDropdown.appendChild(li);
        });
    }
    
    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        currentTheme = theme;
    }
    
    window.setTheme = setTheme;
});