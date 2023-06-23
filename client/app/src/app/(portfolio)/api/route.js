import { NextResponse } from 'next/server'
import {createPortfolio, getAllPortfolios} from "@/services/portfolio/portfolioClient";

export async function PUT() {
    const response = await createPortfolio()

    return NextResponse.json(response)
}

export async function GET() {
    const response = await getAllPortfolios()

    return NextResponse.json(response)
}
