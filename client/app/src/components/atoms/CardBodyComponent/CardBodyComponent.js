import {CardBody } from "@chakra-ui/react";

export default function CardBodyComponent({ children }) {
    return (
        <CardBody m={0}>
            {children}
        </CardBody>
    )
}
