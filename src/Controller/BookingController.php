<?php
declare(strict_types=1);

namespace Hotel\Controller;

use Hotel\Service\RegisterNewBooking;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BookingController
 * @package Hotel\Controller
 * @author Renato Rodrigues de Araujo <renato.r.araujo@gmail.com>
 */
class BookingController extends AbstractController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * BookingController constructor.
     *
     * @param CommandBus $commandBus
     * @param SerializerInterface $serializer
     */
    public function __construct(CommandBus $commandBus, SerializerInterface $serializer)
    {
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/booking")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent());

        $registerBookingCommand = new RegisterNewBooking(
            $requestData->customer,
            $requestData->room,
            new \DateTime($requestData->checkin),
            new \DateTime($requestData->checkout)
        );

        $booking = $this->commandBus->handle($registerBookingCommand);
        $response = $this->serializer->serialize($booking, 'json', ['groups' => ['create-booking']]);

        return new JsonResponse($response, 201, [], true);
    }
}
