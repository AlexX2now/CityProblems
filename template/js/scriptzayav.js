let button = document.getElementById("form-sub");

button.addEventListener('click', function(event) {
    let name = document.getElementById("Name").value;
    let desc = document.getElementById("desc").value;
    let categ = document.getElementById("category").value;
    let photo = document.getElementById("before_photo").value;
    let endphoto = "";

    const fs = require('fs');

    const sourcePath = photo; // путь к исходной картинке
    const destPath = 'img/'; // путь к папке, куда нужно скопировать картинку

    fs.copyFile(sourcePath, destPath + 'problem.jpeg', (err) => {
  if (err) {
    console.error('Error copying image:', err);
    return;
  }
  console.log('Image copied successfully!');
    });
    endphoto = destPath + "p"
})

document.getElementById("forma").addEventListener('submit', function(event) {
    
});
