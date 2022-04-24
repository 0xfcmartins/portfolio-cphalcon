<?php

namespace benchmark;

use Fcmartins\Utils\Encryption;

/**
 * Encryption utils benchmarks
 *
 * @Groups("Encryption")
 * @author Francisco Martins
 * @version 1.000.000, 2022-01-20 21:45
 */
class EncryptionBench
{
    private const BENCH_CASE = "This is a test phrase example!";
    private const BENCH_HASH = "ZVhaeU1GWmxPWEU0VFZGWWNFRkJPR042WW5KTFVYZFJlazFSSzNWU2RrWkxiakZvVm10Q2JWTm5hejA9OnI0MDh"
    . "aQjVaZnFuc0FXQmlxSGhDRnc9PQ";
    private const BENCH_ARRAY = [
        "id" => 12345,
        "sub" => [
            "id" => 12345
        ]
    ];

    /**
     * @Revs(10000)
     * @Iterations(10)
     * @Assert("mode(variant.time.avg) < 15 microseconds +/- 10%")
     */
    public function benchEncryption()
    {
        Encryption::encrypt(self::BENCH_CASE);
    }

    /**
     * @Revs(10000)
     * @Iterations(10)
     * @Assert("mode(variant.time.avg) < 15 microseconds +/- 10%")
     */
    public function benchDecryption()
    {
        Encryption::decrypt(self::BENCH_HASH);
    }

    /**
     * @Revs(10000)
     * @Iterations(10)
     * @Assert("mode(variant.time.avg) < 35 microseconds +/- 10%")
     */
    public function benchEncrypt_object_to_json()
    {
        Encryption::encrypt_object_to_json((object)self::BENCH_ARRAY, ['id']);
    }

    /**
     * @Revs(10000)
     * @Iterations(10)
     * @Assert("mode(variant.time.avg) < 45 microseconds +/- 10%")
     */
    public function benchEncrypt_string_to_json()
    {
        Encryption::encrypt_string_to_json(json_encode((object)self::BENCH_ARRAY), ['id']);
    }

}