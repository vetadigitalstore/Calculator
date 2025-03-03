document.getElementById('calculate').addEventListener('click', () => {
  const sideA = parseFloat(document.getElementById('A').value);
  const sideB = parseFloat(document.getElementById('B').value);
  const hypotenuse = parseFloat(document.getElementById('C').value);
  const angle = parseFloat(document.getElementById('angle').value);
  const results = document.getElementById('results');

  // Clear previous results
  results.innerHTML = '';

  // Calculate Hypotenuse and Angle when Side A and Side B are provided
  if (!isNaN(sideA) && !isNaN(sideB)) {
    const hypotenuseLength = Math.sqrt(sideA ** 2 + sideB ** 2).toFixed(2);
    const angleInRadians = Math.atan(sideB / sideA); // Angle in radians
    const angleInDegrees = (angleInRadians * 180 / Math.PI).toFixed(2); // Convert to degrees
    const thirdAngle = (180 - 90 - angleInDegrees).toFixed(2); // Calculate the third angle
    results.innerHTML += `C: ${hypotenuseLength}<br>`;
    results.innerHTML += `Angle (θ): ${angleInDegrees}°<br>`;
    results.innerHTML += `Third Angle: ${thirdAngle}°<br>`;
  }

  // Calculate Side B and Angle when Side A and Hypotenuse are provided
  else if (!isNaN(sideA) && !isNaN(hypotenuse)) {
    const sideBLength = Math.sqrt(hypotenuse ** 2 - sideA ** 2).toFixed(2);
    const angleInRadians = Math.asin(sideBLength / hypotenuse); // Angle in radians
    const angleInDegrees = (angleInRadians * 180 / Math.PI).toFixed(2); // Convert to degrees
    const thirdAngle = (180 - 90 - angleInDegrees).toFixed(2); // Calculate the third angle
    results.innerHTML += `Side B: ${sideBLength}<br>`;
    results.innerHTML += `Angle (θ): ${angleInDegrees}°<br>`;
    results.innerHTML += `Third Angle: ${thirdAngle}°<br>`;
  }

  // Calculate Side A and Angle when Side B and Hypotenuse are provided
  else if (!isNaN(sideB) && !isNaN(hypotenuse)) {
    const sideALength = Math.sqrt(hypotenuse ** 2 - sideB ** 2).toFixed(2);
    const angleInRadians = Math.asin(sideB / hypotenuse); // Angle in radians
    const angleInDegrees = (angleInRadians * 180 / Math.PI).toFixed(2); // Convert to degrees
    const thirdAngle = (180 - 90 - angleInDegrees).toFixed(2); // Calculate the third angle
    results.innerHTML += `Side A: ${sideALength}<br>`;
    results.innerHTML += `Angle (θ): ${angleInDegrees}°<br>`;
    results.innerHTML += `Third Angle: ${thirdAngle}°<br>`;
  }

  // Calculate Side B and Hypotenuse when Side A and Angle are provided
  else if (!isNaN(sideA) && !isNaN(angle)) {
    const angleInRadians = (angle * Math.PI) / 180; // Convert degrees to radians
    const sideBLength = (sideA * Math.tan(angleInRadians)).toFixed(2);
    const hypotenuseLength = (sideA / Math.cos(angleInRadians)).toFixed(2);
    const thirdAngle = (180 - 90 - angle).toFixed(2); // Calculate the third angle
    results.innerHTML += `Side B: ${sideBLength}<br>`;
    results.innerHTML += `C: ${hypotenuseLength}<br>`;
    results.innerHTML += `Third Angle: ${thirdAngle}°<br>`;
  }

  // Calculate Side A and Hypotenuse when Side B and Angle are provided
  else if (!isNaN(sideB) && !isNaN(angle)) {
    const angleInRadians = (angle * Math.PI) / 180; // Convert degrees to radians
    const sideALength = (sideB / Math.tan(angleInRadians)).toFixed(2);
    const hypotenuseLength = (sideB / Math.sin(angleInRadians)).toFixed(2);
    const thirdAngle = (180 - 90 - angle).toFixed(2); // Calculate the third angle
    results.innerHTML += `Side A: ${sideALength}<br>`;
    results.innerHTML += `C: ${hypotenuseLength}<br>`;
    results.innerHTML += `Third Angle: ${thirdAngle}°<br>`;
  }

  // If inputs are invalid
  else {
    results.innerHTML = "Please provide valid inputs.";
  }
});

document.getElementById('mode-toggle').addEventListener('click', function() {
  document.body.classList.toggle('dark-mode'); // Toggle the dark mode class
});

document.getElementById('calculate').addEventListener('click', () => {
  const sideA = parseFloat(document.getElementById('A').value);
  const sideB = parseFloat(document.getElementById('B').value);
  const hypotenuse = parseFloat(document.getElementById('C').value);
  const angle = parseFloat(document.getElementById('angle').value);
  const results = document.getElementById('results');

  // Clear previous results
  results.innerHTML = '';

  // Calculation logic (unchanged)
  // ...
});


 function downloadSVG() {
            const svgElement = document.getElementById("custom-logo").outerHTML;
            const blob = new Blob([svgElement], { type: "image/svg+xml" });
            const url = URL.createObjectURL(blob);

            const link = document.createElement("a");
            link.href = url;
            link.download = "custom_logo_with_angle_names.svg";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        }