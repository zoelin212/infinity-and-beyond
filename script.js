function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /* Loop through a collection of all HTML elements: */
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /* Make an HTTP request using the attribute value as the file name: */
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) { elmnt.innerHTML = this.responseText; }
          if (this.status == 404) { elmnt.innerHTML = "Page not found."; }
          /* Remove the attribute, and call this function once more: */
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      }
      xhttp.open("GET", file, true);
      xhttp.send();
      /* Exit the function: */
      return;
    }
  }
}
includeHTML();
// Get the real time kp value

// setTimeout(canv, 4000);
function getKpNow() {
  fetch('https://services.swpc.noaa.gov/products/noaa-estimated-planetary-k-index-1-minute.json')
    .then((response) => response.json())
    .then((data) => {
      let now = data[data.length - 1]
      console.log(now[1]);
      let nowVal = now[1] * 10;
      var canv = document.querySelector("canvas");
      canv.style.opacity = now[1] / 10;
    });
}

showNow.addEventListener("click", getKpNow);

const inputs = document.querySelector("form");
wind.value = 600;

//glow.style.background = "radial-gradient(closest-side,rgba(221, 250, 114, 0.1) 0%,rgba(128, 250, 57, 0.1) 30%,rgba(0, 212, 255, 0) 100%)";



setTimeout(pathGen, 5000);
const calendarBtn = document.querySelectorAll('.datechoice'); // creates a <h1> element


// choose location
function pathGen() {
  var canv = document.querySelector("canvas");
  const mapA = document.querySelector("#a");
  const mapB = document.querySelector("#b");
  const mapC = document.querySelector("#c");
  const mapD = document.querySelector("#d");
  const mapE = document.querySelector("#e");
  // console.log(worldMap);
  mapA.addEventListener("click", (item) => {
    canv.style.opacity = "1";
    // console.log(mapA);
  });
  mapB.addEventListener("click", (item) => {
    canv.style.opacity = "0.8";
    // console.log(mapB);
  });
  mapC.addEventListener("click", (item) => {
    canv.style.opacity = "0.4";
    // console.log(mapC);
  });
  mapD.addEventListener("click", (item) => {
    canv.style.opacity = "0.6";
    // console.log(mapD);
  });
  mapE.addEventListener("click", (item) => {
    canv.style.opacity = "0";
    // console.log(mapE);
  });
}

setTimeout(pathGen, 3000);