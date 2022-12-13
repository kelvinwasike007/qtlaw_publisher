import { config } from '../../../lib/config'



/** @type {import('./$types').PageLoad} */
export async function load({fetch, params }) {
    var publications = await fetch(config.api+'list/'+localStorage.getItem('user'), {method: 'GET', headers: {'Content-Type': 'application/json'}})
    return {
        pubs: await publications.json()
    }
  }
  