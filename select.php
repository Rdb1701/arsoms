<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Element</title>
</head>
<body>
  <select id="paginationSelect">
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    <option value="3">Option 3</option>
    
    <!-- ... more options ... -->
  </select>

  <button id="prevButton">Previous</button>
  <button id="nextButton">Next</button>

  <script>
    const selectElement = document.getElementById('paginationSelect');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');

    const optionsPerPage = 3; // Number of options to show per page
    let currentPage = 1;

    function updateOptionsVisibility() {
      const options = selectElement.options;
      const startIndex = (currentPage - 1) * optionsPerPage;
      const endIndex = startIndex + optionsPerPage;

      for (let i = 0; i < options.length; i++) {
        options[i].style.display = (i >= startIndex && i < endIndex) ? 'block' : 'none';
      }
    }

    function updatePaginationButtons() {
      prevButton.disabled = currentPage === 1;
      nextButton.disabled = currentPage >= Math.ceil(selectElement.options.length / optionsPerPage);
    }

    prevButton.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        updateOptionsVisibility();
        updatePaginationButtons();
      }
    });

    nextButton.addEventListener('click', () => {
      if (currentPage < Math.ceil(selectElement.options.length / optionsPerPage)) {
        currentPage++;
        updateOptionsVisibility();
        updatePaginationButtons();
      }
    });
    
    // Initial setup
    updateOptionsVisibility();
    updatePaginationButtons();
  </script>
</body>
</html>