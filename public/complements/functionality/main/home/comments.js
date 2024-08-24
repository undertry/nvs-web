document.addEventListener("DOMContentLoaded", function() {
    const commentsContainer = document.getElementById("comments");

    const usernames = ["schwgon", "Dr-Cristian", "LaureanoCarlos", "Craifran", "Randalfd",
        "TadeoBoglione",
        "Naahuuel"
    ];
    const comments = [
        "The NVS software has significantly enhanced my security by identifying network vulnerabilities. This has been particularly useful for protecting my extensive computer systems. ",
        "I find this product to be excellent in fulfilling its promises. Despite still being in development, it is even better than some paid programs with the same purpose. Thank you.",
        "A well-conceived idea from the initial design, it effectively meets its objectives and is free of defects. Its creators are visionary and proactive individuals.",
        "The website is very pleasant, easy to understand, and visually appealing. The interaction with it is logical and comprehensible. Regarding the software, it is a very interesting idea that is well implemented.",
        "very good service, very simple and practical.",
        "The tool appears to be very useful for addressing current security concerns and frequent attacks. With this device, vulnerabilities are mitigated, and its advanced technology effectively handles highly specific issues.",
        "I found the site dynamic, interactive and with good navigation flow."
    ];
    let allCommentsHTML = "";

    usernames.forEach((username, index) => {
        allCommentsHTML += generateCommentHTML(username, comments[index % comments.length]);
    });

    setTimeout(() => {
        commentsContainer.innerHTML = allCommentsHTML;
        initializeCardPositions();
    }, 500);

    function generateCommentHTML(username, comment) {
        return `
            <div class="comment-card">
                <div class="comment-content">
                    <p>${comment}</p>
                    <h3>@${username}</h3>
                </div>
            </div>
        `;
    }

    function initializeCardPositions() {
        const cards = document.querySelectorAll('.comment-card');

        const positions = [{
                x: 450,
                y: 650
            },
            {
                x: 800,
                y: 200
            },
            {
                x: 0,
                y: 700
            },
            {
                x: 280,
                y: 20
            },
            {
                x: -280,
                y: 20
            },
            {
                x: -450,
                y: 650
            },
            {
                x: -800,
                y: 200
            }
        ];

        cards.forEach((card, index) => {
            const position = positions[index % positions.length];
            card.style.transform = `translate(${position.x}px, ${position.y}px)`;

            card.dataset.initialX = position.x;
            card.dataset.initialY = position.y;
        });

        commentsContainer.addEventListener('mousemove', function(event) {
            const mouseX = event.clientX;
            const mouseY = event.clientY;

            cards.forEach(card => {
                const initialX = parseFloat(card.dataset.initialX);
                const initialY = parseFloat(card.dataset.initialY);

                const deltaX = (mouseX - (initialX + card.clientWidth / 2)) * 0.02;
                const deltaY = (mouseY - (initialY + card.clientHeight / 2)) * 0.02;

                card.style.transform =
                    `translate(${initialX + deltaX}px, ${initialY + deltaY}px)`;
            });
        });
    }
});