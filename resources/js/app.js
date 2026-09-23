import './bootstrap';

const app = document.querySelector('#app');

const userId = app?.dataset.userId;
const state = { quizzes: [], session: null };

const escapeHtml = (value) => String(value)
	.replaceAll('&', '&amp;')
	.replaceAll('<', '&lt;')
	.replaceAll('>', '&gt;')
	.replaceAll('"', '&quot;')
	.replaceAll("'", '&#039;');

const shell = (content) => `
	<main class="mx-auto min-h-screen max-w-5xl px-6 py-12">
		<header class="mb-8">
			<p class="text-sm font-medium uppercase tracking-wide text-indigo-600">Erasmus Project</p>
			<h1 class="mt-2 text-3xl font-semibold">Student quiz</h1>
			<p class="mt-3 text-slate-600">Test your knowledge about Europe and save your score.</p>
		</header>
		${content}
	</main>
`;

const errorMessage = (error) => error instanceof Error ? error.message : 'Something went wrong.';

const request = async (url, options = {}) => {
	const response = await fetch(url, {
		headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
		...options,
	});
	const payload = await response.json().catch(() => ({}));
	if (!response.ok) {
		throw new Error(payload.message ?? 'The server could not complete the request.');
	}
	return payload;
};

const renderQuizPicker = () => {
	const options = state.quizzes.map((quiz) => `
		<option value="${escapeHtml(quiz.slug)}" data-difficulty="${escapeHtml(quiz.difficulty)}">
			${escapeHtml(quiz.name)} - ${escapeHtml(quiz.difficulty)} (${quiz.question_count} questions)
		</option>
	`).join('');

	app.innerHTML = shell(`
		<section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
			<h2 class="text-xl font-semibold">Choose a quiz</h2>
			${userId ? '' : '<p class="mt-3 rounded-md bg-amber-50 p-3 text-amber-800">Please log in before starting a quiz.</p>'}
			<label class="mt-6 block text-sm font-medium" for="quiz-choice">Country and difficulty</label>
			<select class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2" id="quiz-choice">${options}</select>
			<button class="mt-6 rounded-md bg-indigo-600 px-5 py-2 font-medium text-white disabled:cursor-not-allowed disabled:opacity-50" id="start-quiz" type="button" ${userId ? '' : 'disabled'}>Start quiz</button>
			<p class="mt-4 text-sm text-slate-500" id="quiz-status"></p>
		</section>
	`);

	document.querySelector('#start-quiz').addEventListener('click', startQuiz);
};

const renderQuestion = (data) => {
	const options = Object.entries(data.question.options).map(([key, value]) => `
		<label class="flex cursor-pointer items-center gap-3 rounded-lg border border-slate-200 p-4 hover:border-indigo-400">
			<input class="h-4 w-4" type="radio" name="answer" value="${key}" required>
			<span><strong>${key.toUpperCase()}.</strong> ${escapeHtml(value)}</span>
		</label>
	`).join('');

	app.innerHTML = shell(`
		<section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
			<div class="flex flex-wrap justify-between gap-3 text-sm text-slate-500">
				<span>Question ${data.question_number} of ${data.total_questions ?? 10}</span>
				<span>Lives: ${data.lives} | Score: ${data.score ?? 0}</span>
			</div>
			<h2 class="mt-6 text-2xl font-semibold">${escapeHtml(data.question.question_text)}</h2>
			<form class="mt-6 space-y-3" id="answer-form">${options}
				<button class="mt-3 rounded-md bg-indigo-600 px-5 py-2 font-medium text-white" type="submit">Submit answer</button>
				<p class="text-sm text-red-600" id="answer-error"></p>
			</form>
		</section>
	`);
	document.querySelector('#answer-form').addEventListener('submit', submitAnswer);
};

const renderResult = (result) => {
	app.innerHTML = shell(`
		<section class="rounded-xl bg-white p-8 text-center shadow-sm ring-1 ring-slate-200">
			<p class="text-sm font-medium uppercase tracking-wide text-emerald-600">Quiz complete</p>
			<h2 class="mt-2 text-3xl font-semibold">Your result</h2>
			<p class="mt-6 text-5xl font-bold text-indigo-600">${result.total_score}</p>
			<p class="mt-2 text-slate-600">${result.correct_answers} correct answers and ${result.remaining_lives} lives remaining.</p>
			<button class="mt-8 rounded-md bg-indigo-600 px-5 py-2 font-medium text-white" id="play-again" type="button">Play again</button>
		</section>
	`);
	document.querySelector('#play-again').addEventListener('click', renderQuizPicker);
};

const startQuiz = async () => {
	const choice = document.querySelector('#quiz-choice');
	const selected = choice.options[choice.selectedIndex];
	const status = document.querySelector('#quiz-status');
	status.textContent = 'Starting quiz...';
	try {
		const data = await request(`/api/quizzes/${encodeURIComponent(choice.value)}/start`, {
			method: 'POST',
			body: JSON.stringify({ user_id: Number(userId), difficulty: selected.dataset.difficulty }),
		});
		state.session = { id: data.session_id, quiz: choice.value };
		renderQuestion(data);
	} catch (error) {
		status.textContent = errorMessage(error);
	}
};

const submitAnswer = async (event) => {
	event.preventDefault();
	const answer = new FormData(event.currentTarget).get('answer');
	const errorElement = document.querySelector('#answer-error');
	const button = event.currentTarget.querySelector('button');
	button.disabled = true;
	try {
		const data = await request(`/api/quizzes/${encodeURIComponent(state.session.quiz)}/submit`, {
			method: 'POST',
			body: JSON.stringify({ session_id: state.session.id, answer }),
		});
		if (data.finished) {
			renderResult(data.result);
		} else {
			renderQuestion(data);
		}
	} catch (error) {
		button.disabled = false;
		errorElement.textContent = errorMessage(error);
	}
};

const loadQuizzes = async () => {
	if (!app) return;
	app.innerHTML = shell('<p class="text-slate-600">Loading quizzes...</p>');
	try {
		state.quizzes = (await request('/api/quizzes')).data;
		renderQuizPicker();
	} catch (error) {
			app.innerHTML = shell(`<p class="rounded-md bg-red-50 p-4 text-red-700">${escapeHtml(errorMessage(error))}</p>`);
	}
};

const renderAuthNotice = () => {
	app.innerHTML = shell(`
		<section class="rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
			<h2 class="text-xl font-semibold">Authentication is not configured yet</h2>
			<p class="mt-3 text-slate-600">Add Laravel authentication before students can log in and save quiz results.</p>
		</section>
	`);
};

if (app && ['/login', '/register'].includes(window.location.pathname)) {
	renderAuthNotice();
} else if (app) {
	loadQuizzes();
}

const editProfileButton = document.querySelector('#edit-profile');
if (editProfileButton) {
	const profileForm = editProfileButton.closest('form');
	const profileFields = profileForm.querySelectorAll('input');
	const saveProfileButton = profileForm.querySelector('#save-profile');

	editProfileButton.addEventListener('click', () => {
		profileFields.forEach((field) => field.removeAttribute('readonly'));
		saveProfileButton.hidden = false;
		editProfileButton.setAttribute('aria-label', 'Editing profile');
		editProfileButton.title = 'Editing profile';
		profileFields[0]?.focus();
	});
}

const deleteModal = document.querySelector('#delete-modal');
const openDeleteAccountButton = document.querySelector('#open-delete-account');

if (deleteModal && openDeleteAccountButton) {
	const closeDeleteModal = () => {
		deleteModal.hidden = true;
		document.body.classList.remove('modal-open');
	};

	openDeleteAccountButton.addEventListener('click', () => {
		deleteModal.hidden = false;
		document.body.classList.add('modal-open');
		deleteModal.querySelector('.delete-password')?.focus();
	});

	deleteModal.querySelectorAll('[data-close-delete]').forEach((button) => {
		button.addEventListener('click', closeDeleteModal);
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && !deleteModal.hidden) closeDeleteModal();
	});
}
