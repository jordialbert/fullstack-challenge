import { NextResponse } from 'next/server'
import { setOrderState } from "@/services/order/orderClient";

export async function PUT(request) {
    const body = await request.json()
    const response = await setOrderState(body.id, body.state)

    return NextResponse.json(response)
}
