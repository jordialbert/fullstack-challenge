'use client'

import { useRouter } from 'next/navigation'

export default function handleClickFactoryFromAction(action) {
    const router = useRouter();

    let handleClick;

    switch (action) {
        case "put_portfolio":
            handleClick = async () => {
                const response = await fetch('/api', {method: 'PUT'});
                router.refresh();
            }
            break;

        case "get_orders":
            handleClick = async () => {
                const response = await fetch('/api', {method: 'PUT'});
                router.refresh();
            }
            break;

        default:
            handleClick = () => {};
            break;
    }

    return handleClick;
}
