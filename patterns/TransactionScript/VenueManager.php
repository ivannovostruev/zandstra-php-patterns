<?php

namespace patterns\TransactionScript;

class VenueManager extends Base
{
    public static string $addVenue = "INSERT INTO venue (name) values (?)";
    public static string $addSpace = "INSERT INTO space (name, venue) values (?, ?)";
    public static string $checkSlot = "SELECT id, name
                                        FROM event
                                        WHERE space = ?
                                        AND (start + duration) > ? 
                                        AND start < ?";
    public static string $addEvent = "INSERT INTO event (name, space, start, duration) values (?, ?, ?, ?)";

    /**
     * @param string $name
     * @param array $spaces
     * @return array
     */
    public function addVenue(string $name, array $spaces): array
    {
        $venueData = [];
        $venueData['venue'] = [$name];
        $this->doStatement(self::$addVenue, $venueData['venue']);
        $venueId = self::$db->lastInsertId();
        $venueData['spaces'] = [];
        foreach ($spaces as $spaceName) {
            $values = [$spaceName, $venueId];
            $this->doStatement(self::$addSpace, $values);
            $spaceId = self::$db->lastInsertId();
            array_unshift($values, $spaceId);
            $venueData['spaces'][] = $values;
        }
        return $venueData;
    }

    public function addEvent(int $spaceId, string $name, int $time, int $duration)
    {
        $values = [$spaceId, $time, ($time + $duration)];
        $stmt = $this->doStatement(self::$checkSlot, $values);
        if ($result = $stmt->fetch()) {
            throw new AppException('Пространство уже занято. Попробуйте ещё раз');
        }
        $this->doStatement(self::$addEvent, [$name, $spaceId, $time, $duration]);
    }
}
