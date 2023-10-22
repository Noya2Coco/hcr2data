const tableContainer = document.querySelector('.table-container');

function checkScrollbar() {
	console.clear();
	console.log('scrollWidth:', tableContainer.scrollWidth);
	console.log('clientWidth:', tableContainer.clientWidth);
	console.log('clientWidth:', tableContainer.scrollWidth > tableContainer.clientWidth);
	if (tableContainer.scrollWidth > tableContainer.clientWidth) {
		tableContainer.style.justifyContent = 'flex-start';
	}
	else {
		tableContainer.style.justifyContent = 'center';
	}
}

window.addEventListener('load', checkScrollbar);
window.addEventListener('resize', checkScrollbar);



