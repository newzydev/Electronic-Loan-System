// var clickmessage = "อ๊ะ! อย่า save ภาพสิคะ";

function disableclick(e) {
  if (document.all) {
    if (event.button == 2 || event.button == 3) {
      if (event.srcElement.tagName == "IMG") {
        // alert(clickmessage);
        $("#saveimg").modal("show");
        return false;
      }
    }
  } else if (document.layers) {
    if (e.which == 3) {
      $("#saveimg").modal("show");
      return false;
    }
  } else if (document.getElementById) {
    if (e.which == 3 && e.target.tagName == "IMG") {
      $("#saveimg").modal("show");
      return false;
    }
  }
}

// ตรวจสอบการกดปุ่ม Save บนภาพ
window.addEventListener("contextmenu", function (event) {
  var target = event.target;
  if (target.tagName === "IMG") {
    event.preventDefault(); // ป้องกันเมนู Context Menu จากการแสดงขึ้น
    $("#saveimg").modal("show");
  }
});

function associateimages() {
  for (i = 0; i < document.images.length; i++)
    document.images[i].onmousedown = disableclick;
}

if (document.all) document.onmousedown = disableclick;
else if (document.getElementById) document.onmouseup = disableclick;
else if (document.layers) associateimages();

// ----------------------------------

// var message = "อ๊ะ! อย่าคลิกขวา สิคะ";
function clickIE4() {
  if (event.button == 2) {
    // alert(message);
    $("#message").modal("show");
    return false;
  }
}
function clickNS4(e) {
  if (document.layers || (document.getElementById && !document.all)) {
    if (e.which == 2 || e.which == 3) {
      // alert(message);
      $("#message").modal("show");
      return false;
    }
  }
}
if (document.layers) {
  document.captureEvents(Event.MOUSEDOWN);
  document.onmousedown = clickNS4;
} else if (document.all && !document.getElementById) {
  document.onmousedown = clickIE4;
}
document.oncontextmenu = new Function("$('#message').modal('show');return false");

//ทริกเกอร์คีย์
document.onkeydown = function () {
  // ห้ามกด Ctrl + U
  var message1 = "อ๊ะ! อย่ากด Ctrl + U สิคะ";
  if (event.ctrlKey && window.event.keyCode == 85) {
    // alert(message1);
    $("#message1").modal("show");
    return false;
  }
  // ห้ามกด F12
  var message2 = "อ๊ะ! อย่ากด F12 สิคะ";
  if (window.event && window.event.keyCode == 123) {
    // alert(message2);
    $("#message2").modal("show");
    event.keyCode = 0;
    event.returnValue = false;
  }
  // ห้ามกด Ctrl + S
  var message3 = "อ๊ะ! อย่ากด Ctrl + S สิคะ";
  if (event.ctrlKey && window.event.keyCode == 83) {
    // alert(message3);
    $("#message3").modal("show");
    return false;
  }
  // ห้ามกด F5
  var message4 = "อ๊ะ! อย่ากด F5 สิคะ";
  if (window.event && window.event.keyCode == 116) {
    // alert(message4);
    $("#message4").modal("show");
    event.keyCode = 0;
    event.returnValue = false;
  }
  // ห้ามกด Ctrl+ Shift + i
  var message5 = "อ๊ะ! อย่ากด Ctrl+ Shift + i สิคะ";
  if (event.ctrlKey && event.shiftKey && event.key === "I") {
    // alert(message3);
    event.preventDefault();
    $("#message6").modal("show");
    return false;
  }
};
