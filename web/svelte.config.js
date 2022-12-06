import adapter from '@sveltejs/adapter-node@next'

/** @type {import('@sveltejs/kit').Config} */
const config = {
	kit: {
		adapter: adapter({
			fallback: '200.html'
		}),
		prerender: {
			entries: []
		}
	}
};

export default config;
