import React from "react";
import { Box, Image, Heading } from "@chakra-ui/react";
import { Swiper, SwiperSlide } from "swiper/react";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

export default function Carousel({ children }) {
    return (
      <Box maxW="4xl" mx="auto" mt={10}>
        <Swiper
          modules={[Navigation, Pagination, Autoplay]}
          navigation
          pagination={{ clickable: true }}
          autoplay={{ delay: 3000 }}
          loop
          spaceBetween={20}
          slidesPerView={1}
        >
          {children.map((child , idx) => (
            <SwiperSlide key={idx}>
              {child}
            </SwiperSlide>
          ))}
        </Swiper>
      </Box>
    );
  }
  