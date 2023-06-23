'use client'

import { Text } from "@chakra-ui/react";

export default function cardBodyTextFactoryFromPage(page, element) {
    let cardBodyText;

    switch (page) {
        case "portfolio-list":
            cardBodyText = <>
                <Text fontSize={"1.25rem"} fontWeight={"bold"}>Allocations: {element.allocations ? element.allocations.length : 0}</Text>
                <Text fontSize={"1.25rem"} fontWeight={"bold"}>Orders: {element.orders ? element.orders.length : 0}</Text>
            </>;
            break;

        case "portfolio-detail":
            cardBodyText = <>
                <Text fontSize={"1.25rem"} fontWeight={"bold"}>Shares: {element.shares ? element.shares.shares : 0}</Text>
                <Text fontSize={"1.25rem"} fontWeight={"bold"}>Orders: {element.orders ? element.orders.length : 0}</Text>
            </>;
            break;

        default:
            cardBodyText = "";
            break;
    }

    return cardBodyText;
}
