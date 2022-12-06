import { config } from '../../../lib/config'


/** @type {import('./$types').PageLoad} */
export async function load({ params }) {
    var publications = await fetch(config.api+'template/list', {method: 'GET', headers: {'Content-Type': 'application/json'}})
    return {
        pubs: await publications.json()
    }
  }
  