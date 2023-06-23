import { v4 as uuidv4 } from 'uuid';

export const getAllPortfolios = async () => {
    const response = await fetch(
        `${process.env.NEXT_PUBLIC_SERVER_URL}/portfolio/get-all`,
        { next: { revalidate: 10 } }
    )

    if (!response.ok) {
        throw new Error('Failed to fetch data')
    }

    return response.json()
}

export const getPortfolioAllocations = async (id) => {
    const response = await fetch(
        `${process.env.NEXT_PUBLIC_SERVER_URL}/allocation/get-all-by-portfolio?portfolioId=${id}`,
        { next: { revalidate: 10 } }
    )

    if (!response.ok) {
        throw new Error('Failed to fetch data')
    }

    return response.json()
}

export const createPortfolio = async () => {
    const response = await fetch(
        `${process.env.NEXT_PUBLIC_SERVER_URL}/portfolio/${uuidv4()}`,
        {
            method: 'PUT'
        }
    )

    if (!response.ok) {
        throw new Error('Failed to fetch data')
    }

    return response.json()
}
