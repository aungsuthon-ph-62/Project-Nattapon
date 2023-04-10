const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
sendIcon = document.querySelector("#sendIcon");

form.onsubmit = (e)=>{
    e.preventDefault();
}

// เปลี่ยนสีช่องพิมพ์ข้อความและไอคอนส่งข้อความ
inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        inputField.classList.add("active");
        sendBtn.classList.add("active");
        sendIcon.classList.remove("fa-ellipsis");
        sendIcon.classList.add("fa-location-arrow");
    }else{
        inputField.classList.remove("active");
        sendBtn.classList.remove("active");
        sendIcon.classList.remove("fa-location-arrow");
        sendIcon.classList.add("fa-ellipsis");
    }
}


sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}


chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 1000);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  