    // JavaScript to toggle dropdown visibility on hover
    document.addEventListener("DOMContentLoaded", function() {
        // Get the dropdown menu element
        var dropdownMenus = document.querySelectorAll('.dropdown-menu');
        // Get all the parent nav items
        var navItems = document.querySelectorAll('.nav-item.dropdown');

        navItems.forEach(function(navItem, index) {
            var dropdownMenu = dropdownMenus[index];
            
            // Function to handle mouseenter event
            var showDropdown = function() {
                dropdownMenu.classList.add('show');
            };

            // Function to handle mouseleave event
            var hideDropdown = function() {
                dropdownMenu.classList.remove('show');
            };

            // Add event listeners
            navItem.addEventListener('mouseenter', showDropdown);
            navItem.addEventListener('mouseleave', hideDropdown);
            
            // Hide dropdown menu initially
            dropdownMenu.classList.remove('show');
        });
    });