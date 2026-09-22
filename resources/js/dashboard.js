const app = document.querySelector('#app');

if (app) {
	app.innerHTML = `
		<main class="mx-auto flex min-h-screen w-full max-w-5xl items-center justify-center px-6 py-12">
			<section class="w-full rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
				<p class="text-sm font-medium uppercase tracking-wide text-indigo-600">Erasmus Project</p>
				<h1 class="mt-2 text-3xl font-semibold">Dashboard</h1>
				<p class="mt-3 text-slate-600">Je bent ingelogd. Deze pagina wordt door JavaScript weergegeven.</p>
			</section>
		</main>
	`;
}
