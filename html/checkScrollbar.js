const tableContainers = document.querySelectorAll('.table-container');

function checkScrollbar() {
  tableContainers.forEach(function(tableContainer) {
    if (tableContainer.scrollWidth > tableContainer.clientWidth) {
      tableContainer.style.justifyContent = 'flex-start';
    }
    else {
      tableContainer.style.justifyContent = 'center';
    }
  });
}

window.addEventListener('load', checkScrollbar);
window.addEventListener('resize', checkScrollbar);
