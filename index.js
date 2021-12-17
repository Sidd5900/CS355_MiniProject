var shopbut = document.getElementById("shopbut");
var licensebut = document.getElementById("licensebut");
var billbut = document.getElementById("billbut");
var paybut = document.getElementById("paybut");
var chargesbut = document.getElementById("chargesbut");
var gatepassbut = document.getElementById("gatepassbut");
var summarybut = document.getElementById("summarybut");

var shopdiv = document.getElementById("shopdiv");
var licensediv = document.getElementById("licensediv");
var billdiv = document.getElementById("billdiv");
var paydiv = document.getElementById("paydiv");
var chargesdiv = document.getElementById("chargesdiv");
var gatepassdiv = document.getElementById("gatepassdiv");
var summarydiv = document.getElementById("summarydiv");

shopbut.onclick = function () {
  shopdiv.style.display = "block";
  licensediv.style.display = "none";
  billdiv.style.display = "none";
  paydiv.style.display = "none";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "none";
};

licensebut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "block";
  billdiv.style.display = "none";
  paydiv.style.display = "none";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "none";
};

billbut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "none";
  billdiv.style.display = "block";
  paydiv.style.display = "none";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "none";
};

paybut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "none";
  billdiv.style.display = "none";
  paydiv.style.display = "block";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "none";
};

chargesbut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "none";
  billdiv.style.display = "none";
  paydiv.style.display = "none";
  chargesdiv.style.display = "block";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "none";
};

gatepassbut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "none";
  billdiv.style.display = "none";
  paydiv.style.display = "none";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "block";
  summarydiv.style.display = "none";
};

summarybut.onclick = function () {
  shopdiv.style.display = "none";
  licensediv.style.display = "none";
  billdiv.style.display = "none";
  paydiv.style.display = "none";
  chargesdiv.style.display = "none";
  gatepassdiv.style.display = "none";
  summarydiv.style.display = "block";
};
