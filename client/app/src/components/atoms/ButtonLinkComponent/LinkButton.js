'use client'

import NextLink from "next/link";
import { Button, Link } from "@chakra-ui/react";

export default function LinkButton({ buttonText, href = "", onClick = () => {} }) {
    return (
        <Link as={NextLink} href={href}>
            <Button background={"#D3BD80"} color={"#212121"} fontSize={"1.25rem"} fontWeight={"bold"} onClick={onClick}>{buttonText}</Button>
        </Link>
    )
}
