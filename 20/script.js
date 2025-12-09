const canvas = document.querySelector("#draw");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const btn = document.querySelector("#clear");
btn.addEventListener("click", clear);

ctx.strokeStyle = "#BADA55";
ctx.lineJoin = "round";
ctx.lineCap = "round";
ctx.lineWidth = 10;

let isDrawing = false;
let lastX = 0;
let lastY = 0;
let hue = 0;

function clear() {
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
    console.log("clear clicked");
    console.clear();
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function randomBox() {
    const x = getRandomInt(0, ctx.canvas.width / 2);
    const y = getRandomInt(0, ctx.canvas.height / 2);
    console.log(x);
    hue = getRandomInt(0, 360);
    ctx.fillStyle = `hsl(${hue}, 100%, 50%)`;
    // ctx.beginPath();
    ctx.fillRect(x, y, x, y);
    // ctx.stroke();
}

function draw(e) {
    if (!isDrawing) return;

    ctx.strokeStyle = `hsl(${hue}, 100%, 50%)`;
    console.log(e);
    console.log(`hue: ${hue}`);
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
    [lastX, lastY] = [e.offsetX, e.offsetY];
    hue++;
    if (hue > 360) {
        hue = 0;
    }
}

setInterval(randomBox, 100);

canvas.addEventListener("mousemove", draw);
canvas.addEventListener("mousedown", (e) => {
    isDrawing = true;
    [lastX, lastY] = [e.offsetX, e.offsetY];
});
canvas.addEventListener("mouseup", () => {
    isDrawing = false;
});
canvas.addEventListener("mouseout", () => {
    isDrawing = false;
});
