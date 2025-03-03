let display = document.getElementById('display');
let currentValue = '0';
let isEditable = false;

// Function to append value to the display
function appendValue(value) {
  if (!isEditable) return;

  // If the current value is '0' and the user is not typing a '.', replace it
  if (currentValue === '0' && value !== '.') {
    currentValue = value;
  } else {
    currentValue += value;
  }
  display.value = currentValue;
}

// Function to clear the display
function clearDisplay() {
  currentValue = '';
  display.value = '0';
}

// Function to clear the last character entered
function clearLast() {
  currentValue = currentValue.slice(0, -1); // Remove the last character
  if (currentValue === '') {
    currentValue = '0'; // Reset to '0' if the string is empty
  }
  display.value = currentValue;
}

// Function to calculate the result
function calculateResult() {
  try {
    currentValue = eval(currentValue).toString(); // Calculate the result
    display.value = currentValue;
  } catch (e) {
    display.value = 'Error'; // In case of invalid calculation, show 'Error'
  }
}

// Function to enable editing the display
function enableEditing() {
  isEditable = true; // Allow the user to edit the display
  display.readOnly = false; // Make the display field editable
}

// Function to disable editing the display
function disableEditing() {
  isEditable = false; // Disable editing
  display.readOnly = true; // Make the display field readonly
}

// Function for special calculations
function appendFunction(value) {
  if (!isEditable) return;
  currentValue += value;
  display.value = currentValue;
}

// Handle key press events (optional, if you want to handle keyboard input)
document.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    calculateResult();
  } else if (event.key === 'Backspace') {
    clearLast();
  } else if (/[0-9+\-*/%().]/.test(event.key)) {
    appendValue(event.key);
  }
});