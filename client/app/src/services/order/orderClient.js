export const getPortfolioOrders = async (id) => {
    const response = await fetch(
        `${process.env.NEXT_PUBLIC_SERVER_URL}/order/get-all-by-portfolio?portfolioId=${id}`,
        { next: { revalidate: 10 } }
    )

    if (!response.ok) {
        throw new Error('Failed to fetch data')
    }

    return response.json()
}

export const setOrderState = async (id, state) => {
    const response = await fetch(
        `${process.env.NEXT_PUBLIC_SERVER_URL}/order/${id}/set-state`,
        {
            method: 'PUT',
            body: JSON.stringify({state: state})
        }
    )

    if (!response.ok) {
        throw new Error('Failed to fetch data')
    }

    return response.json()
}
