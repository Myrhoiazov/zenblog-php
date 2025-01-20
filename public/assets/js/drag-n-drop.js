const lists = document.querySelectorAll('.list');
const button = document.querySelector('.button');
const btn = document.querySelector('.add__btn'),
	addBtn = document.querySelector('.add__item-btn'),
	cancelBtn = document.querySelector('.cancel__item-btn'),
	textarea = document.querySelector('.textarea'),
	form = document.querySelector('.form');

function addTask() {
	let value;

	btn.addEventListener('click', () => {
		textarea.value = '';
		form.style.display = 'block';
		btn.style.display = 'none';
		addBtn.style.display = 'none';

		textarea.addEventListener('input', (e) => {
			value = e.target.value;

			if (!value) {
				addBtn.style.display = 'none';
			} else {
				addBtn.style.display = 'block';
			}
		});
	});

	cancelBtn.addEventListener('click', () => {
		cleanForm();
	});

	addBtn.addEventListener('click', () => {
		const newItem = document.createElement('div');
		newItem.classList.add('list__item');
		newItem.draggable = true;
		newItem.textContent = value;
		lists[0].appendChild(newItem);

		cleanForm();
		dragNdrop();
	});
}

function cleanForm() {
	textarea.value = '';
	value = '';
	form.style.display = 'none';
	btn.style.display = 'flex';
}
addTask();

// Add new Board
function addBoard() {
	const boards = document.querySelector('.boards');
	const boardItem = createItem();
	boards.append(boardItem);

	changeTitle();
	dragNdrop();
}

function createItem() {
	const boardItem = document.createElement('div');
	boardItem.classList.add('boards__item');
	boardItem.innerHTML = `
  <span contenteditable="true" class="title">Type name</span><div class="list"> 
  <div class="add__btn"><span>+</span> Add card</div></div>`;

	return boardItem;
}
button.addEventListener('click', addBoard);

// Change Title
function changeTitle() {
	const titles = document.querySelectorAll('.title');

	titles.forEach((title) =>
		title.addEventListener('click', (e) => (e.target.textContent = ''))
	);
}
changeTitle();

// Drag - n - Drop
let draggin = null;

function dragNdrop() {
	const listsDrag = document.querySelectorAll('.list'),
		listItems = document.querySelectorAll('.list__item');

	listItems.forEach((item) => {
		item.addEventListener('dragstart', () => {
			draggin = item;
			setTimeout(() => {
				item.style.display = 'none';
			}, 100);
		});

		item.addEventListener('dragend', () => {
			setTimeout(() => {
				item.style.display = 'block';
				draggin = null;
			}, 0);
		});

		item.addEventListener('dblclick', () => {
			item.remove();
		});

		listsDrag.forEach((listItem) => {
			listItem.addEventListener('dragover', (e) => {
				e.preventDefault();
			});

			listItem.addEventListener('dragenter', function (e) {
				e.preventDefault();

				this.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
			});

			listItem.addEventListener('dragleave', function (e) {
				e.preventDefault();

				this.style.backgroundColor = 'rgba(0, 0, 0, 0)';
			});

			listItem.addEventListener('drop', function (e) {
				e.preventDefault();

				this.style.backgroundColor = 'rgba(0, 0, 0, 0)';
				this.append(draggin);
			});
		});
	});
}

dragNdrop();
