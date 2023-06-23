'use client'

import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    ChakraProvider,
    Flex,
    Grid,
    Heading
} from "@chakra-ui/react";

import CardComponent from "@/components/molecules/CardComponent/CardComponent";
import LinkButton from "@/components/atoms/ButtonLinkComponent/LinkButton";
import cardBodyTextFactoryFromPage from "@/services/factory/cardBodyTextFactoryFromPage";
import handleClickFactoryFromAction from "@/services/factory/handleClickFactoryFromAction";
import {ChevronRightIcon} from "@chakra-ui/icons";
import {cormorant} from "@/app/theme";

export default function ListOfCards({
    data,
    heading = "",
    createNewText = "",
    cardHeaderText = "",
    cardFooterElement = false,
    href = false,
    navigateTo = "",
    cardFooterButtonText = "",
    page = "",
    handleClickAction = "",
    dynamicId = ""
}) {
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
                {
                    dynamicId
                    ? <Breadcrumb p={"1rem"} spacing='8px' separator={<ChevronRightIcon color='gray.500' />}>
                            <BreadcrumbItem>
                                <BreadcrumbLink href='/' color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Portfolios</BreadcrumbLink>
                            </BreadcrumbItem>

                            <BreadcrumbItem isCurrentPage>
                                <BreadcrumbLink href='#' color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Allocations</BreadcrumbLink>
                            </BreadcrumbItem>
                        </Breadcrumb>
                    : <Breadcrumb p={"1rem"} spacing='8px' separator={<ChevronRightIcon color='gray.500' />}>
                            <BreadcrumbItem isCurrentPage>
                                <BreadcrumbLink href='/' color={"#D3BD80"} fontSize={"1.25rem"} fontWeight={"bold"} >Portfolios</BreadcrumbLink>
                            </BreadcrumbItem>
                        </Breadcrumb>
                }

                <Heading fontFamily={cormorant.style.fontFamily} color={"#fff"} fontSize={"4rem"} >{heading}</Heading>

                {
                    href
                    ? <LinkButton onClick={handleClickFactoryFromAction(handleClickAction)} href={navigateTo} buttonText={createNewText}/>
                    : <LinkButton onClick={handleClickFactoryFromAction(handleClickAction)} buttonText={createNewText}/>
                }

                <Grid
                    width={"60%"}
                    gap={3}
                    templateColumns='repeat(auto-fit, minmax(175px, 2fr))'
                    mt={"2rem"}
                    mb={"2rem"}
                >
                    {
                        data.map((element, index) => {
                            if (cardFooterElement) {
                                return <CardComponent
                                    key={element.id.value}
                                    cardHeader={<Heading fontFamily={cormorant.style.fontFamily} size='lg'>{cardHeaderText} {index + 1}</Heading>}
                                    cardBody={cardBodyTextFactoryFromPage(page, element)}
                                    cardFooter={
                                        href
                                            ? <LinkButton href={`/${element.id.value}`}
                                                          buttonText={cardFooterButtonText}/>
                                            : <LinkButton buttonText={cardFooterButtonText}/>
                                    }
                                />
                            } else {
                                return <CardComponent
                                    key={element.id.value}
                                    cardHeader={<Heading fontFamily={cormorant.style.fontFamily} size='lg'>{cardHeaderText} {index + 1}</Heading>}
                                    cardBody={cardBodyTextFactoryFromPage(page, element)}
                                />
                            }
                        })
                    }
                </Grid>

            </Flex>
        </ChakraProvider>
    )
}
