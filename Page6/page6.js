var progressNo = document.querySelector('.head').innerHTML;

var slicedInnerHTML = progressNo.slice(22, 24);

var progress = slicedInnerHTML;

function drawProgressBar(progress) {

    var container = document.getElementById("progress");
    var proCircle = document.createElement("canvas");
    proCircle.id = "progressCanvas";
    proCircle.width = "300";
    proCircle.height = "300";

    container.appendChild(proCircle);

    var canvas = proCircle;
    var context = canvas.getContext('2d');

    var centerX = canvas.width / 2;
    var centerY = canvas.height / 2;
    var radius = 130;
    var startAngle = -0.5 * Math.PI;
    var endAngle = startAngle + (progress / 100) * (2 * Math.PI);
    var counterClockwise = false;

    context.clearRect(0, 0, canvas.width, canvas.height);

    // Draw background circle
    context.beginPath();
    context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
    context.lineWidth = 20;
    context.strokeStyle = '#ddd';
    context.stroke();

    // Draw progress arc
    context.beginPath();
    context.arc(centerX, centerY, radius, startAngle, endAngle, counterClockwise);
    context.lineWidth = 20;
    context.strokeStyle = '#4CAF50';
    context.stroke();

    var img = new Image();
    img.src = 'img/horo1.png';
    img.onload = function () {
        var imgWidth = img.width;
        var imgHeight = img.height;
        var scaleFactor = Math.min((2 * radius) / imgWidth, (2 * radius) / imgHeight);

        imgWidth *= scaleFactor;
        imgHeight *= scaleFactor;

        var imgX = centerX - imgWidth / 2;
        var imgY = centerY - imgHeight / 2;

        context.beginPath();
        context.arc(centerX, centerY, 116, 0, 2 * Math.PI);
        context.clip();
        context.fillStyle = 'black';
        context.fillRect(centerX - radius, centerY - radius, 2 * radius, 2 * radius);


        context.drawImage(img, imgX, imgY, imgWidth, imgHeight);
    };
    // drawHeart(context, centerX + radius * Math.cos(endAngle), centerY + radius * Math.sin(endAngle)-10, 25);
}

// function drawHeart(context, x, y, size) {
//     context.beginPath();
//     context.moveTo(x, y);
//     context.bezierCurveTo(x + size / 2, y - size / 2, x + size * 2, y + size / 3, x, y + size);
//     context.bezierCurveTo(x - size * 2, y + size / 3, x - size / 2, y - size / 2, x, y);
//     context.fillStyle = 'red';
//     context.fill();
//   }

drawProgressBar(progress);

