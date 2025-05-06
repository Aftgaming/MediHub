// Function to open a tab
function openTab(tabName) {
    const tabContents = document.querySelectorAll('.tab-content');
    const tabButtons = document.querySelectorAll('.tab-button');

    // Hide all tab contents and remove 'active' class from buttons
    tabContents.forEach((content) => {
        content.style.display = 'none';
    });
    tabButtons.forEach((button) => {
        button.classList.remove('active');
    });

    // Show the selected tab content and set button to active
    document.getElementById(tabName).style.display = 'block';
    document.querySelector(`.tab-button[onclick="openTab('${tabName}')"]`).classList.add('active');
}

// Open the default tab
openTab('services');

// Image Carousel Logic
const images = [
    'images/service1.jpg', // First image
    'images/service2.jpg', // Second image
    'images/service3.jpg'  // Third image (Add more images if needed)
];

let currentIndex = 0;

const carouselImg = document.getElementById('carousel-img');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');

function updateImage() {
    carouselImg.src = images[currentIndex];
}

prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : images.length - 1;
    updateImage();
});

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex < images.length - 1) ? currentIndex + 1 : 0;
    updateImage();
});
