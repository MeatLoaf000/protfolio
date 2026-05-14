console.log("=== SYSTEM BOOT INITIATED ===");

// 1. Core Profile Data
const studentName = "Yasir Ibrahim";
const studentTitle = "Software Engineering Student";

document.addEventListener('DOMContentLoaded', () => {
    // 2. Inject Name and Title 
    const nameElement = document.getElementById('hero-name');
    const titleElement = document.getElementById('hero-title');
    
    if (nameElement) nameElement.innerText = studentName;
    if (titleElement) titleElement.innerText = studentTitle;

    
    fetch('fetch_data.php?type=skills')
        .then(response => response.json())
        .then(skills => {
            const skillsContainer = document.getElementById('skills-container');
            if (skillsContainer) {
                skillsContainer.innerHTML = ''; // Clear container
                skills.forEach(skill => {
                    const span = document.createElement('span');
                    span.className = 'skill-tag';
                    span.innerText = skill;
                    skillsContainer.appendChild(span);
                });
            }
        })
        .catch(error => console.error('Error loading skills:', error));

    // 4. Fetch Projects Dynamically from Database
    fetch('fetch_data.php?type=projects')
        .then(response => response.json())
        .then(projects => {
            const projectsContainer = document.getElementById('projects-container');
            if (projectsContainer) {
                projectsContainer.innerHTML = ''; // Clear the static HTML project
                projects.forEach(proj => {
                    
                    projectsContainer.innerHTML += `
                        <div class="project-item">
                            <h3>${proj.title}</h3>
                            <p>${proj.description}</p>
                            <blockquote class="tumblr-quote">
                                Stack: ${proj.tech_stack}
                            </blockquote>
                            <a href="Finsihed_Projects.jpg" target="_blank" style="color: var(--link-color); text-decoration: none; font-size: 14px; font-weight: bold; display: inline-block; margin-top: 5px;">
                                View Finished Project ➔
                            </a>
                        </div>
                    `;
                });
            }
        })
        .catch(error => console.error('Error loading projects:', error));

    // 5. Mouse Hover Glow Effect
    const glow = document.querySelector('.mouse-glow');
    if (glow) {
        window.addEventListener('mousemove', (e) => {
            glow.style.setProperty('--mouse-x', `${e.clientX}px`);
            glow.style.setProperty('--mouse-y', `${e.clientY}px`);
        });
    }

    // 6. Client-Side Form Validation & AJAX
    const contactForm = document.getElementById('contact-form');
    const formFeedback = document.getElementById('form-feedback');

    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const nameInput = document.getElementById('name').value.trim();
            const emailInput = document.getElementById('email').value.trim();
            const messageInput = document.getElementById('message').value.trim();

            if (nameInput === "" || emailInput === "" || messageInput === "") {
                formFeedback.style.color = "#EF4444"; 
                formFeedback.innerText = "Error: All fields are required.";
                return;
            }

            if (!emailInput.includes("@") || !emailInput.includes(".")) {
                formFeedback.style.color = "#EF4444";
                formFeedback.innerText = "Error: Please enter a valid email format.";
                return;
            }

            formFeedback.style.color = "#60A5FA"; 
            formFeedback.innerText = "Transmitting message to server...";

            const formData = new FormData(contactForm);

            fetch('submit_form.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.status === 'success') {
                    formFeedback.style.color = "#10B981"; 
                    formFeedback.innerText = data.message;
                    contactForm.reset(); 
                } else {
                    formFeedback.style.color = "#EF4444"; 
                    formFeedback.innerText = data.message;
                }
            })
            .catch(error => {
                formFeedback.style.color = "#EF4444";
                formFeedback.innerText = "Critical Error: Could not connect to the database.";
                console.error("AJAX Error:", error);
            });
        });
    }
});

console.log("=== SYSTEM BOOT COMPLETE ===");