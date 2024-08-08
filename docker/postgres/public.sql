/*
 Navicat Premium Dump SQL

 Source Server         : Docker Symfony Project
 Source Server Type    : PostgreSQL
 Source Server Version : 160003 (160003)
 Source Host           : 127.0.0.1:5432
 Source Catalog        : symfony
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160003 (160003)
 File Encoding         : 65001

 Date: 01/08/2024 16:45:19
*/


-- ----------------------------
-- Table structure for doctrine_migration_versions
-- ----------------------------
DROP TABLE IF EXISTS "public"."doctrine_migration_versions";
CREATE TABLE "public"."doctrine_migration_versions" (
  "version" varchar(191) COLLATE "pg_catalog"."default" NOT NULL,
  "executed_at" timestamp(0) DEFAULT NULL::timestamp without time zone,
  "execution_time" int4
)
;
ALTER TABLE "public"."doctrine_migration_versions" OWNER TO "symfony";

-- ----------------------------
-- Records of doctrine_migration_versions
-- ----------------------------
BEGIN;
INSERT INTO "public"."doctrine_migration_versions" ("version", "executed_at", "execution_time") VALUES ('App\Shared\Infrastructure\Database\Migrations\Version20240706235206', '2024-07-17 08:02:53', 14);
INSERT INTO "public"."doctrine_migration_versions" ("version", "executed_at", "execution_time") VALUES ('App\Shared\Infrastructure\Database\Migrations\Version20240726082748', '2024-07-26 10:28:20', 20);
COMMIT;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS "public"."products";
CREATE TABLE "public"."products" (
  "ulid" varchar(26) COLLATE "pg_catalog"."default" NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "sku" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default" DEFAULT NULL::character varying,
  "price" numeric(10,2) NOT NULL,
  "is_active" bool NOT NULL
)
;
ALTER TABLE "public"."products" OWNER TO "symfony";

-- ----------------------------
-- Records of products
-- ----------------------------
BEGIN;
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3Q6TTN7D57CNJQJDNWAKVCR', 'Product Coventry', 'coventry', NULL, 100.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3Q62WXB79S1WBCHCPTPMNGJ', 'Product Channel', 'Channel', NULL, 100.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3Q6FWCCZYVS4AZ57H5FVD03', 'Product Kenzo', 'Kenzo', NULL, 100.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3Q6J4K3JJMZW6JTERBFS52Y', 'Product Monza', 'Monza', NULL, 100.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAB1QNJKDTFZKPESSW9J5F', 'Product 1', 'SKU123', NULL, 100.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAB1RN0DQBWDPSFPKJ56P4', 'Product 2', 'SKU124', NULL, 150.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2M2PBEK6R8S0H6QZ55Z', 'delectus', 'harum', NULL, 279.30, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MS374A0K47XNK05K29', 'est', 'eius', NULL, 570.44, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MTP7VXYAZ9V6YHWXYV', 'architecto', 'non', NULL, 267.37, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MVT48EGG5YMTY13TMP', 'commodi', 'repellendus', NULL, 88.00, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MVT48EGG5YMTY13TMQ', 'incidunt', 'ratione', NULL, 705.18, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MWWRMX7VJ32CZAQ1G1', 'minus', 'natus', NULL, 283.37, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MX1K8KPV0D1YWA0732', 'aut', 'laborum', NULL, 630.85, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MYJ73S4Q2QQ1NNHA8X', 'enim', 'quia', NULL, 245.67, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MZC6DYZZJ0BXZJ6GF5', 'magnam', 'voluptatem', NULL, 39.79, 'f');
INSERT INTO "public"."products" ("ulid", "name", "sku", "description", "price", "is_active") VALUES ('01J3QAJ2MZC6DYZZJ0BXZJ6GF6', 'architecto', 'omnis', NULL, 362.47, 'f');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "ulid" varchar(26) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;
ALTER TABLE "public"."users" OWNER TO "symfony";

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO "public"."users" ("ulid", "email", "password") VALUES ('01J302HNBVFCGT40SM4HW8MZRY', 'email@example.com', 'password123');
INSERT INTO "public"."users" ("ulid", "email", "password") VALUES ('01J30D7CH1ZF3K9SCQMWBFRWW5', 'jdoe@example.com', 'vayatela');
INSERT INTO "public"."users" ("ulid", "email", "password") VALUES ('01J30GH7WTEX0YFY9E5CRAVH0T', 'pdoe@example.com', '$2y$13$FkjoTNfRmU.2796A0VxnT.4BPYfuB8TIjRkprDp7EYsbiVQjxXe0G');
INSERT INTO "public"."users" ("ulid", "email", "password") VALUES ('01J3D1N282V6VF2K0TTS8Y0HJB', 'mdoe@example.com', '$2y$13$cP1MPEC4pB2ThBHaerxrSeDINBPtrL.PLW0JEJtwHQYZ6hSRsVhxa');
INSERT INTO "public"."users" ("ulid", "email", "password") VALUES ('01J3Q343229GBECQESHTBE1CXZ', 'moe@example.com', '$2y$13$NQX9nSTB9hRF1LMatgvfn.5bEtS1aIuD2vu/QdHN/4P.RcgY8Vi0y');
COMMIT;

-- ----------------------------
-- Primary Key structure for table doctrine_migration_versions
-- ----------------------------
ALTER TABLE "public"."doctrine_migration_versions" ADD CONSTRAINT "doctrine_migration_versions_pkey" PRIMARY KEY ("version");

-- ----------------------------
-- Primary Key structure for table products
-- ----------------------------
ALTER TABLE "public"."products" ADD CONSTRAINT "products_product_pkey" PRIMARY KEY ("ulid");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_user_pkey" PRIMARY KEY ("ulid");
