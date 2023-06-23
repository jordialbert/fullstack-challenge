import { extendTheme } from '@chakra-ui/react';
import { Cormorant } from 'next/font/google'

export const cormorant = Cormorant({ subsets: ['latin'] })

const theme = extendTheme({
    fonts: {
        body: cormorant.style.fontFamily,
        heading: cormorant.style.fontFamily,
    },
    components: {
        Heading: {
            fontFamily: cormorant.style.fontFamily
        }
    }
});


export default theme;