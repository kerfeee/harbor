const grid = document.getElementById("files_grid");
const selectFile = document.getElementById("dblclick_file");
const folderImg = "<img src=\"folders.png\" height=\"80px\"/>";
const fileImg = "<img src=\"file.png\" height=\"60px\"/>";
const imgTypes = [".jpeg", ".gif", ".png", ".jpg", ".ico", ".bmp", ".tiff", ".tif", ".svg"];

for (let i = 0; i < folders.length; i++) {
  let appendDiv = document.createElement("DIV");
  appendDiv.setAttribute("class", "files");
  appendDiv.innerHTML = fileImg;

  let appendP = document.createElement("P");
  appendP.setAttribute("class", "files");
  appendP.innerText = folders[i];

  appendDiv.appendChild(appendP);
  grid.appendChild(appendDiv);
}

var files = document.getElementsByClassName("files");
var xhr = new XMLHttpRequest();

for (let i = 0; i < files.length; i++) {
  files[i].addEventListener("dblclick", function(e) {
    let fileName = e.target;

    if (fileName.tagName == "IMG" || fileName.tagName == "P") {
      console.log(e.target.parentElement.lastElementChild.innerText);
      selectFile.value = fileName.parentElement.lastElementChild.innerText;
      document.getElementById("download_link").setAttribute("href", "../file-db/"+username+"/"+selectFile.value);
      dotPosition = selectFile.value.lastIndexOf(".");
      fileExtension = selectFile.value.substr(dotPosition, selectFile.value.length);
      console.log(fileExtension);

      xhr.open("GET", "../file-db/"+username+"/"+selectFile.value, true);
      xhr.send();

      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (imgTypes.includes(fileExtension)) {
            document.getElementById("file_data").innerHTML = "<iframe src=\"../file-db/"+username+"/"+selectFile.value+"\"></iframe>";
          } else {
            document.getElementById("file_data").innerText = this.responseText;
          }
        }
      }
    }

    document.getElementById("data_container").style.display = "block";
  })

  files[i].addEventListener("click", function(e) {
    for (let i = 0; i < files.length; i++) {
      document.getElementsByClassName("files")[i].style.background = "none";
    }

    if (e.target.tagName == "IMG" || e.target.tagName == "P") {
      e.target.parentElement.lastElementChild.style.background = "lightskyblue";
    }
  })
}

document.getElementById("escape_arrow").addEventListener("click", function() {
  document.getElementById("data_container").style.display = "none";
})

document.getElementById("delete").addEventListener("click", function() {
  document.getElementById("hidden_form").submit();
})
