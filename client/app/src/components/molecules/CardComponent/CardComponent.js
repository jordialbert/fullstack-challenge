'use client'

import { Card } from "@chakra-ui/react";
import CardHeaderComponent from "@/components/atoms/CardHeaderComponent/CardHeaderComponent";
import CardBodyComponent from "@/components/atoms/CardBodyComponent/CardBodyComponent";
import CardFooterComponent from "@/components/atoms/CardFooterComponent/CardFooterComponent";

export default function CardComponent({ cardHeader = <></>, cardBody = <></>, cardFooter = <></> }) {
    return (
        <Card maxWidth={"200px"}>
            <CardHeaderComponent>
                {cardHeader}
            </CardHeaderComponent>
            <CardBodyComponent>
                {cardBody}
            </CardBodyComponent>
            <CardFooterComponent>
                {cardFooter}
            </CardFooterComponent>
        </Card>
    )
}
