'use client';

import {
    Breadcrumb, BreadcrumbItem, BreadcrumbLink,
    ChakraProvider,
    Flex,
    Heading,
    IconButton,
    Table,
    TableContainer,
    Tbody,
    Td,
    Th,
    Thead,
    Tr
} from "@chakra-ui/react";
import LinkButton from "@/components/atoms/ButtonLinkComponent/LinkButton";
import {CheckIcon, ChevronRightIcon, CloseIcon} from "@chakra-ui/icons";
import { useRouter } from "next/navigation";
import {cormorant} from "@/app/theme";

export default function TableComponent({
    data,
    heading = "",
    createNewText = "",
    dynamicId = ""
}) {
    const router = useRouter();

    return (
        <ChakraProvider>

            <Flex
                height={"100%"}
                width={"100vw"}
                justifyContent={"center"}
                alignItems={"center"}
                direction={"column"}
                rowGap={10}
            >
                <Breadcrumb p={"1rem"} spacing='8px' separator={<ChevronRightIcon color='gray.500' />}>
                    <BreadcrumbItem>
                        <BreadcrumbLink href='/' color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Portfolios</BreadcrumbLink>
                    </BreadcrumbItem>

                    <BreadcrumbItem>
                        <BreadcrumbLink href={`/${dynamicId}`} color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Allocations</BreadcrumbLink>
                    </BreadcrumbItem>

                    <BreadcrumbItem isCurrentPage>
                        <BreadcrumbLink href='#' color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Orders</BreadcrumbLink>
                    </BreadcrumbItem>
                </Breadcrumb>

                <Heading fontFamily={cormorant.style.fontFamily} color={"#fff"} fontSize={"4rem"} >{heading}</Heading>

                <LinkButton buttonText={createNewText}/>

                <TableContainer maxWidth={"100%"} overflowY={"scroll"} fontSize={"1.25rem"} fontWeight={"bold"}>
                    <Table variant='simple'>
                        <Thead>
                            <Tr>
                                <Th color={"#D3BD80"} fontSize={"1rem"} textAlign={"center"}>Order</Th>
                                <Th color={"#D3BD80"} fontSize={"1rem"} textAlign={"center"}>Type</Th>
                                <Th color={"#D3BD80"} fontSize={"1rem"} isNumeric textAlign={"center"}>Shares</Th>
                                <Th color={"#D3BD80"} fontSize={"1rem"} textAlign={"center"}>State</Th>
                                <Th color={"#D3BD80"} fontSize={"1rem"} textAlign={"center"}>Created At</Th>
                                <Th color={"#D3BD80"} fontSize={"1rem"} textAlign={"center"}>Accept</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {
                                data.map((element, index) => {
                                    return (
                                        <Tr key={element.id.value}>
                                            <Td textAlign={"center"}>Order {index + 1}</Td>
                                            <Td textAlign={"center"}>{element.type.type}</Td>
                                            <Td textAlign={"center"}>{element.shares.shares}</Td>
                                            <Td textAlign={"center"}>{element.state.state}</Td>
                                            <Td textAlign={"center"}>{
                                                new Date(element.createdAt.date)
                                                    .toLocaleDateString('es-es', {
                                                        year: 'numeric',
                                                        month: 'numeric',
                                                        day: 'numeric',
                                                        hour: 'numeric',
                                                        minute: 'numeric',
                                                        second: 'numeric'
                                                    })
                                                }
                                            </Td>
                                            <Td>
                                                <Flex justifyContent={"space-evenly"}>
                                                    <IconButton
                                                        colorScheme='green'
                                                        aria-label='check'
                                                        icon={<CheckIcon w={4} h={4}  />}
                                                        m={"0.5rem"}
                                                        isRound={true}
                                                        display={element.state.state === 'rejected' ? "none" : "block"}
                                                        isDisabled={element.state.state !== 'placed'}
                                                        onClick={(async (event) => {
                                                            const response = await fetch(
                                                                'orders/api',
                                                                {
                                                                    method: 'PUT',
                                                                    body: JSON.stringify({
                                                                        id: element.id.value,
                                                                        state: 'accepted'
                                                                    })
                                                                }
                                                            );
                                                            router.refresh();
                                                        })}
                                                    />
                                                    <IconButton
                                                        colorScheme='red'
                                                        aria-label='check'
                                                        icon={<CloseIcon w={4} h={4}  />}
                                                        m={"0.5rem"}
                                                        isRound={true}
                                                        display={element.state.state === 'accepted' ? "none" : "block"}
                                                        isDisabled={element.state.state !== 'placed'}
                                                        onClick={(async (event) => {
                                                            const response = await fetch(
                                                                'orders/api',
                                                                {
                                                                    method: 'PUT',
                                                                    body: JSON.stringify({
                                                                        id: element.id.value,
                                                                        state: 'rejected'
                                                                    })
                                                                }
                                                            );
                                                            router.refresh();
                                                        })}
                                                    />
                                                </Flex>
                                            </Td>
                                        </Tr>
                                    )
                                })
                            }
                        </Tbody>
                    </Table>
                </TableContainer>

            </Flex>

        </ChakraProvider>
    )
}
