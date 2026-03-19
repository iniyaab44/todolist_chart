// ===== CHART FUNCTIONS =====
// Load charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadCharts();
    initializePasswordToggles(); // Initialize password toggles if needed
});

function loadCharts() {
    fetch('tasks/get_chart_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.labels && data.labels.length > 0) {
                createPieChart(data);
                createLineChart(data);
            } else {
                // Show message if no data
                document.querySelectorAll('.chart-box').forEach(box => {
                    box.innerHTML = '<p style="text-align:center; padding:20px; color:#666;">No task data available for charts.</p>';
                });
            }
        })
        .catch(error => {
            console.error('Error loading charts:', error);
            // Show user-friendly message
            document.querySelectorAll('.chart-box').forEach(box => {
                box.innerHTML = '<p style="text-align:center; padding:20px; color:#666;">Unable to load charts. Please try again later.</p>';
            });
        });
}

function createPieChart(data) {
    const canvas = document.getElementById('pieChart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    
    // Generate random colors for each task
    const colors = data.labels.map(() => {
        return `hsl(${Math.random() * 360}, 70%, 50%)`;
    });
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Task Distribution'
                }
            }
        }
    });
}

function createLineChart(data) {
    const canvas = document.getElementById('lineChart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Task Frequency',
                data: data.values,
                borderColor: '#87CEEB',
                backgroundColor: 'rgba(135, 206, 235, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Task Trends'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
}

// ===== PASSWORD SHOW/HIDE FUNCTIONALITY =====
function togglePasswordVisibility(inputId, element) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    const icon = element.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Initialize password toggles for dynamically loaded content
function initializePasswordToggles() {
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        // Remove any existing listeners to prevent duplicates
        toggle.removeEventListener('click', handleToggleClick);
        toggle.addEventListener('click', handleToggleClick);
    });
}

function handleToggleClick(e) {
    const toggle = e.currentTarget;
    const inputId = toggle.closest('.password-group')?.querySelector('input')?.id;
    if (inputId) {
        togglePasswordVisibility(inputId, toggle);
    }
}

// ===== TIME VALIDATION =====
function validateTime() {
    const startTime = document.getElementById('start_time')?.value;
    const endTime = document.getElementById('end_time')?.value;
    
    if (startTime && endTime) {
        if (startTime >= endTime) {
            alert('End time must be after start time');
            return false;
        }
    }
    return true;
}

// ===== FORM SUBMISSION HANDLER =====
document.addEventListener('submit', function(e) {
    // Handle task form submission
    if (e.target.id === 'taskForm') {
        if (!validateTime()) {
            e.preventDefault();
        }
    }
});

// ===== KEYBOARD SUPPORT FOR PASSWORD TOGGLE =====
document.addEventListener('keydown', function(e) {
    // Check if Enter key was pressed on a password toggle element
    if (e.key === 'Enter' && e.target.classList.contains('password-toggle')) {
        e.preventDefault(); // Prevent any default action
        e.target.click(); // Trigger the click handler
    }
});

// ===== ADDITIONAL UTILITY FUNCTIONS =====
// Optional: Add password strength indicator for registration
function checkPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[$@#&!]+/)) strength++;
    
    return strength;
}

// Optional: Real-time password match validation
function validatePasswordMatch() {
    const password = document.getElementById('password')?.value;
    const confirmPassword = document.getElementById('confirm_password')?.value;
    
    if (password && confirmPassword) {
        if (password !== confirmPassword) {
            // You can add visual feedback here
            return false;
        }
    }
    return true;
}

// Re-initialize password toggles if new content is loaded dynamically
// You can call this function after AJAX loads new content
document.addEventListener('DOMContentLoaded', function() {
    initializePasswordToggles();
});

// If you're using AJAX to load content, call this after content load
// window.initializePasswordToggles = initializePasswordToggles;