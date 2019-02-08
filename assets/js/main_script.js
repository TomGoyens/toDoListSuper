//init

var list = document.querySelector('.toDoList');
list.addEventListener('click', checkToDo);

var addToDoBtn = document.querySelector(".addToDoBtn");
addToDoBtn.addEventListener ('click', addToToDo);

var listItems = document.getElementsByClassName("toDoListItem");
for (var i = 0; i < listItems.length; i++){
  listItems[i].children[0].addEventListener('click', deleteToDo);
}

var toDoItem = document.querySelector('.inputToDo');

addToDoBtn.addEventListener('click', getToDoFunction);

//the rest
function addToToDo(){
  if(toDoItem.value != ""){
    var toDoListItem = document.createElement("li");
    toDoListItem.classList.add("toDoListItem");
    var toDoListItemClose = document.createElement("span");
    toDoListItem.innerHTML = toDoItem.value;
    toDoListItemClose.innerHTML = "\u00D7";
    var theToDoList = document.querySelector(".toDoList");

    var xhr = new XMLHttpRequest();

    xhr.onload = function() {
      if (this.status == 200) {
          let id = parseInt(this.responseText)+1;
          toDoListItem.classList.add(id);
      }
    }

    xhr.open("GET", "./assets/php/updateToDo.php?getId=yes", true);
    xhr.send();

    theToDoList.addEventListener('click', checkToDo);
    toDoListItemClose.addEventListener("click", deleteToDo);
    toDoListItem.appendChild(toDoListItemClose);
    theToDoList.appendChild(toDoListItem);
  }
}

function checkToDo(event){
  if (event.target.tagName === 'LI') {
    event.target.classList.toggle('checked');
    var pls = event.target.classList[1];
    if (event.target.classList.length == 3){
      var xhr = new XMLHttpRequest();

      xhr.open("GET", "./assets/php/updateToDo.php?checkItem="+pls, true);
      xhr.send();
    } else {
      var xhr = new XMLHttpRequest();

      xhr.open("GET", "./assets/php/updateToDo.php?uncheckItem="+pls, true);
      xhr.send();
    }

  }
}


function deleteToDo(event){
  event.target.parentElement.remove(event.target.parentElement);
  var pls = event.target.parentElement.classList[1];
  var xhr = new XMLHttpRequest();

  xhr.open("GET", "./assets/php/updateToDo.php?remove="+pls, true);
  xhr.send();
}

function getToDoFunction(){
  update = toDoItem.value;
  if(update.trim() != ""){
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "./assets/php/updateToDo.php?update="+update, true);
    xhr.send();

  }
}
